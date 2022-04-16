<?php

namespace App\Filament\Resources\WardResource\RelationManagers;

use App\Models\Patient;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class BedsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'beds';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => Patient::where('first_name', 'like', "%{$searchQuery}%")
                        ->orWhere('middle_name', 'like', "%{$searchQuery}%")
                        ->orWhere('last_name', 'like', "%{$searchQuery}%")
                        ->limit(50)->pluck('first_name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (Patient::find($value)?->full_name ))
                ,
                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ])->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient.full_name')->label('Patient Name')->sortable()->searchable(['first_name','middle_name', 'last_name']),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->html(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->prependBulkActions([
                Tables\Actions\BulkAction::make('Remove Patient')
                    ->action(fn (Collection $records) => $records->each->removePatient())
                    ->requiresConfirmation()
                    ->color('warning')
                    ->icon('heroicon-o-ban'),
            ])
            ->filters([
                //
            ]);
    }
}
