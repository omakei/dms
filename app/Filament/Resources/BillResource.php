<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillResource\Pages;
use App\Filament\Resources\BillResource\RelationManagers;
use App\Models\Bill;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;

class BillResource extends Resource
{
    protected static ?string $model = Bill::class;

    protected static ?string $navigationIcon = 'heroicon-o-cash';

    protected static ?string $navigationGroup = 'Patient Care';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Patient Name')->sortable()->searchable(['first_name','middle_name', 'last_name']),
                Tables\Columns\TextColumn::make('visit.visit_number')
                    ->label('Patient Visit')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('bill_number')->sortable()->searchable(),
                Tables\Columns\BadgeColumn::make('payment_status')->colors([
                    'pending' => 'warning',
                    'paid' => 'success',
                    'canceled' => 'danger'
                ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->prependActions([
                auth()->user()->hasRole('laboratory')?
                    Tables\Actions\LinkAction::make('bill')
                        ->url(fn (Bill $record) => route('bill.download', $record->id))
                        ->icon('heroicon-o-download')
                        ->color('primary'):Tables\Actions\LinkAction::make('bill')
                                                ->url(fn (Bill $record) => route('bill.download', $record->id))
                                                ->icon('heroicon-o-download')
                                                ->color('primary')
                ,
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\BillItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBills::route('/'),
            'create' => Pages\CreateBill::route('/create'),
            'edit' => Pages\EditBill::route('/{record}/edit'),
            'view' => Pages\ViewBill::route('/{record}'),
        ];
    }
}
