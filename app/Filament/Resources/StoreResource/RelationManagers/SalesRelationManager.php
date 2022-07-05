<?php

namespace App\Filament\Resources\StoreResource\RelationManagers;

use App\Models\Medicine;
use App\Models\PatientVisit;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SalesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'sales';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_prescription_id')
                    ->label('Patient Visit Number')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => PatientVisit::where('visit_number', 'like', "%{$searchQuery}%")
                        ->limit(50)->pluck('visit_number', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (PatientVisit::find($value)?->visit_number ))
                    ->required(),
                Forms\Components\Select::make('medicine_id')
                    ->label('Medicine')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => Medicine::where('name', 'like', "%{$searchQuery}%")
                        ->orWhere('manufacture', 'like', "%{$searchQuery}%")->limit(50)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (Medicine::find($value)?->name ))
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('visit.visit_number')->label('Patient Visit Number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('medicine.name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ]);
    }
}
