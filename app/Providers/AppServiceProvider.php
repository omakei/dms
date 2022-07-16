<?php

namespace App\Providers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Inventory;
use App\Models\LaboratoryTest;
use App\Models\PatientInvestigation;
use App\Models\PatientPrescription;
use App\Models\PatientVisit;
use App\Models\Purchases;
use App\Models\Sale;
use App\Models\Store;
use App\Models\VitalSign;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        Filament::serving(function () {
            Filament::registerTheme(mix('css/filament.css'));
        });



        VitalSign::creating(function ($vital_sign) {
            $vital_sign->bmi = $vital_sign->weight/($vital_sign->height* $vital_sign->height);
            $vital_sign->patient_id = (PatientVisit::find($vital_sign->patient_visit_id))->id;
        });

        PatientInvestigation::created(function ($patient_investigation) {
            $bill = Bill::where(['patient_visit_id' => $patient_investigation->patient_visit_id])->first();

            BillItem::create([
                'bill_id' => $bill->id,
                'billable_id' => $patient_investigation->laboratory_test_id,
                'billable_type' => LaboratoryTest::class
            ]);
        });

        PatientInvestigation::deleted(function ($patient_investigation) {
            $bill = Bill::where(['patient_visit_id' => $patient_investigation->patient_visit_id])->first();

            $bill_item = BillItem::where([
                'bill_id' => $bill->id,
                'billable_id' => $patient_investigation->id,
                'billable_type' => get_class($patient_investigation)
            ])->first();

            $bill_item->delete();
        });

        PatientPrescription::created(function ($patient_prescription) {
            $bill = Bill::where(['patient_visit_id' => $patient_prescription->patient_visit_id])->first();

            BillItem::create([
                'bill_id' => $bill->id,
                'billable_id' => $patient_prescription->medicine->id,
                'billable_type' => get_class($patient_prescription->medicine)
            ]);
        });

        PatientPrescription::deleted(function ($patient_prescription) {
            $bill = Bill::where(['patient_visit_id' => $patient_prescription->patient_visit_id])->first();

            $bill_item = BillItem::where([
                'bill_id' => $bill->id,
                'billable_id' => $patient_prescription->medicine->id,
                'billable_type' => get_class($patient_prescription->medicine)
            ])->first();

            $bill_item->delete();
        });

        Purchases::created(function ($purchase) {
            $store = Store::inRandomOrder()->first();
           $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $purchase->medicine_id])->first();
           if(empty($inventory)){
               Inventory::create([
                   'store_id' => $store->id,
                   'medicine_id' => $purchase->medicine_id,
                   'quantity' => $purchase->quantity
               ]);
           }
           if(!empty($inventory)){
               $inventory->update([
                   'quantity' => $inventory->quantity + $purchase->quantity
               ]);
           }

        });

        Purchases::updated(function ($purchase) {
            $store = Store::inRandomOrder()->first();
            $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $purchase->medicine_id])->first();

            if(!empty($inventory)){
                $inventory->update([
                    'quantity' => $inventory->quantity + $purchase->quantity
                ]);
            }

        });

        Purchases::deleted(function ($purchase) {
            $store = Store::inRandomOrder()->first();
            $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $purchase->medicine_id])->first();

            if(!empty($inventory)){
                $inventory->update([
                    'quantity' => $inventory->quantity - $purchase->quantity
                ]);
            }

        });

        Sale::created(function ($sale) {
            $store = Store::inRandomOrder()->first();
            $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $sale->medicine_id])->first();

            if(!empty($inventory)){
                $inventory->update([
                    'quantity' => $inventory->quantity - $sale->quantity
                ]);
            }

        });

        Sale::updating(function ($sale) {
            $store = Store::inRandomOrder()->first();
            $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $sale->medicine_id])->first();

            if(!empty($inventory)){
                $inventory->update([
                    'quantity' => $inventory->quantity + $sale->quantity
                ]);
            }

        });

        Sale::deleted(function ($sale) {
            $store = Store::inRandomOrder()->first();
            $inventory = Inventory::where(['store_id'=> $store->id, 'medicine_id' => $sale->medicine_id])->first();

            if(!empty($inventory)){
                $inventory->update([
                    'quantity' => $inventory->quantity + $sale->quantity
                ]);
            }

        });
    }
}
