<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Models\PatientVisit;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class VitalSignsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'vital_signs';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Vital Signs';

    protected static ?string $label = 'Vital sign';

    protected static ?string $pluralLabel = 'Vital Signs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('temperature')
                    ->label('Temperature in ℃')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('height')
                    ->label('height in cm')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('weight')
                    ->label('weight in kg')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('systolic_pressure')
                    ->label('systolic pressure in mmHg')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('diastolic_pressure')
                    ->label('diastolic pressure in mmHg')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('respiratory_rate')
                    ->label('respiratory rate in Breaths/Min')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('oxygen_saturation')
                    ->label('oxygen saturation in %')
                    ->required()
                    ->numeric()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pulse_rate')
                    ->label('pulse rate in Beats/Min')
                    ->required()
                    ->numeric()
                    ->maxLength(255),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    Tables\Columns\TextColumn::make('created_at')
                        ->dateTime(),
                    Tables\Columns\TextColumn::make('temperature')
                        ->label('Temperature in ℃'),
                    Tables\Columns\TextColumn::make('height')
                        ->label('Height in cm'),
                    Tables\Columns\TextColumn::make('weight')
                        ->label('Weight in kg'),
                    Tables\Columns\TextColumn::make('systolic_pressure')
                        ->label('Systolic pressure in mmHg'),
                    Tables\Columns\TextColumn::make('diastolic_pressure')
                        ->label('Diastolic pressure in mmHg'),
                    Tables\Columns\TextColumn::make('respiratory_rate')
                        ->label('Respiratory rate in Breaths/Min'),
                    Tables\Columns\TextColumn::make('oxygen_saturation')
                        ->label('Oxygen saturation in %'),
                    Tables\Columns\TextColumn::make('pulse_rate')
                        ->label('Pulse rate in Beats/Min'),
                    Tables\Columns\TextColumn::make('bmi')
                        ->label('BMI')->limit(5),


            ])
            ->filters([
                //
            ]);
    }
}
