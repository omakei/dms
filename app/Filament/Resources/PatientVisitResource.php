<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientVisitResource\Pages;
use App\Filament\Resources\PatientVisitResource\RelationManagers;
use App\Models\Attendant;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\VisitType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PatientVisitResource extends Resource
{
    protected static ?string $model = PatientVisit::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right';

    protected static ?string $navigationGroup = 'Patient Care';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                    ->label('patient')
                    ->options(Patient::all()->pluck('full_name', 'id'))
                    ->searchable(['first_name', 'middle_name','last_name', 'patient_number'])
                    ->required(),
                Forms\Components\Select::make('attendant_id')
                    ->label('Doctor')
                    ->options(Attendant::all()->pluck('full_name', 'id'))
                    ->searchable(['first_name', 'middle_name','last_name'])
                    ->required(),
                Forms\Components\Select::make('visit_type_id')
                    ->label('Visit type')
                    ->options(VisitType::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->hidden()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')
                    ->label('Patient name')
                    ->searchable(['patient.first_name','patient.middle_name','patient.last_name',]),
                Tables\Columns\TextColumn::make('attendant.full_name')
                    ->label('Doctor name')
                    ->searchable(['attendant.first_name','attendant.middle_name','attendant.last_name',]),
                Tables\Columns\TextColumn::make('visit_type.name')->label('Visit Type'),
                Tables\Columns\TextColumn::make('started_at')
                    ->date(),
                Tables\Columns\TextColumn::make('ended_at')
                    ->date(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatientVisits::route('/'),
            'create' => Pages\CreatePatientVisit::route('/create'),
            'edit' => Pages\EditPatientVisit::route('/{record}/edit'),
        ];
    }
}
