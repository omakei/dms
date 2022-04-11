<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\ICD10Code;
use App\Models\LaboratoryTest;
use App\Models\Medicine;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class JsonDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (json_decode(File::get(public_path("data/countries.json"))) as $country) {
            Country::firstOrCreate([
                'name' => $country->name,
                'code' => $country->code
            ]);
        }

        $country = Country::firstWhere('code','TZ');

        foreach (json_decode(File::get(public_path("data/regions.json"))) as $region) {

            Region::firstOrCreate(
                ['name' => $region->name],
                ['country_id' => $country->id]
            );
        }

        foreach (json_decode(File::get(public_path("data/regions.json"))) as $region) {

            $reg = Region::where('name','LIKE', '%'. $region->name .'%')->first();

            if (!empty($reg)) {
                foreach ($region->districts as $district) {
                    District::firstOrCreate(
                        ['region_id' => $reg->id,],
                        ['name' => $district]
                    );
                }
            }

        }

        foreach (json_decode(File::get(public_path("data/lab-tests.json"))) as $test) {
            LaboratoryTest::firstOrCreate([
                'name' => $test->DESC,
                'sample_type' => $test->SAMPLETYPE,
                'code' => $test->CODE,
                'price' => $test->COST,
                'sample_type_description' => $test->SAMPLETYPE_DESCP,
                'container_description' => $test->CONTAINER_DESCP,
            ]);
        }


        foreach (json_decode(File::get(public_path("data/medicine.json"))) as $medicine) {
//dd($medicine?->openfda?->brand_name[0]);
            if(!empty($medicine->openfda->brand_name[0])) {
                Medicine::firstOrCreate([
                    'name' => $medicine?->openfda?->brand_name[0],
                    'manufacture' => $medicine?->openfda?->manufacturer_name[0],
                    'route' => !empty($medicine?->openfda?->route[0])?$medicine?->openfda?->route[0]:'',
                    'ingredient' => !empty($medicine?->inactive_ingredient[0])?$medicine?->inactive_ingredient[0]:'',
                    'purpose' => !empty($medicine?->purpose[0])?$medicine?->purpose[0]:'',
                    'price' => rand(10000,9999999),
                ]);
            }

        }

        foreach (json_decode(File::get(public_path("data/icd10_code.json"))) as $icd10) {
            ICD10Code::firstOrCreate([
                'description' => $icd10->Description,
                'code' => $icd10->Code,
            ]);
        }

        $department_data = [
            [
                'name' => 'Bood Bank',
                'code_name' => 'BB',
                'description' => Str::random(100),
                'icon_class' => 'fa-blood'
            ],
            [
                'name' => 'Outpatient',
                'code_name' => 'OPD',
                'description' => Str::random(100),
                'icon_class' => 'fa-opd'
            ],
            [
                'name' => 'Clinic',
                'code_name' => 'CC',
                'description' => Str::random(100),
                'icon_class' => 'fa-clinic'
            ],
            [
                'name' => 'Referral',
                'code_name' => 'RR',
                'description' => Str::random(100),
                'icon_class' => 'fa-referral'
            ],
            [
                'name' => 'ICU',
                'code_name' => 'ICU',
                'description' => Str::random(100),
                'icon_class' => 'fa-icu'
            ],
            [
                'name' => 'Inpatient',
                'code_name' => 'IPD',
                'description' => Str::random(100),
                'icon_class' => 'fa-ipd'
            ],
            [
                'name' => 'Appointment',
                'code_name' => 'AA',
                'description' => Str::random(100),
                'icon_class' => 'fa-calender'
            ],
            [
                'name' => 'Theater',
                'code_name' => 'TT',
                'description' => Str::random(100),
                'icon_class' => 'fa-theater'
            ],
            [
                'name' => 'RCH',
                'code_name' => 'RCH',
                'description' => Str::random(100),
                'icon_class' => 'fa-rch'
            ],
            [
                'name' => 'Mortuary',
                'code_name' => 'MM',
                'description' => Str::random(100),
                'icon_class' => 'fa-mortuary'
            ],
            [
                'name' => 'Emergency',
                'code_name' => 'EE',
                'description' => Str::random(100),
                'icon_class' => 'fa-emergency'
            ],
        ];

        foreach ($department_data as $department) {
            Department::firstOrCreate(
                ['name' => $department['name'],
                    'code_name' => $department['code_name']],
                [
                    'description' => $department['description'],
                    'icon_class' => $department['icon_class']
                ]);

        }
    }
}
