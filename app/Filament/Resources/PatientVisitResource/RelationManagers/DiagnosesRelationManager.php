<?php

namespace App\Filament\Resources\PatientVisitResource\RelationManagers;

use App\Models\ICD10Code;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class DiagnosesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'diagnoses';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Diagnoses';

    protected static ?string $label = 'Diagnosis';

    protected static ?string $pluralLabel = 'Diagnoses';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Diagnosis Type')
                    ->required()
                    ->options([
                        'Provisional' => 'Provisional',
                        'Differential' => 'Differential',
                        'Confirmed' => 'Confirmed',
                    ]),
                Forms\Components\Select::make('i_c_d10_code_id')
                    ->label('ICD10 Code')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => ICD10Code::where('code', 'like', "%{$searchQuery}%")
                        ->orWhere('description', 'like', "%{$searchQuery}%")->limit(50)->pluck('code', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (ICD10Code::find($value)?->code ))

                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('i_c_d10_code.code')
                    ->tooltip(fn (Model $record): string => $record->i_c_d10_code->description)
                    ->label('ICD10 Code'),
            ])
            ->filters([
                //
            ]);
    }
}
