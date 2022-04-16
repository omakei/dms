<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use App\Models\Medicine;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class PrescriptionsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'prescriptions';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('medicine_id')
                    ->label('Medicine')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => Medicine::where('name', 'like', "%{$searchQuery}%")
                        ->orWhere('manufacture', 'like', "%{$searchQuery}%")->limit(50)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (Medicine::find($value)?->name ))
                    ->required(),
                Forms\Components\TextInput::make('dosage')
                    ->maxLength(255),
                Forms\Components\TextInput::make('frequency')
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->maxLength(255),
                Forms\Components\Select::make('food_relation')
                    ->label('Food Relation')
                    ->required()
                    ->options([
                        'before' => 'Before',
                        'after' => 'After',
                    ]),
                Forms\Components\Select::make('route')
                    ->label('Route')
                    ->required()
                    ->options([
                        'Oral' => 'Oral',
                        'Injection' => 'Injection',
                        'Sublingual and buccal' => 'Sublingual and buccal',
                        'Rectal' => 'Rectal',
                        'Vaginal' => 'Vaginal',
                        'Ocular' => 'Ocular',
                        'Otic' => 'Otic',
                        'Nasal' => 'Nasal',
                        'Inhalation' => 'Inhalation',
                        'Nebulization' => 'Nebulization',
                        'Cutaneous' => 'Cutaneous',
                        'Transdermal' => 'Transdermal',
                    ]),
                Forms\Components\RichEditor::make('instructions')
                    ->label('Instructions')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('medicine.name')
                    ->label('Medicine'),
                Tables\Columns\BooleanColumn::make('dispensed'),
                Tables\Columns\TextColumn::make('dosage'),
                Tables\Columns\TextColumn::make('frequency'),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('food_relation'),
                Tables\Columns\TextColumn::make('route'),
                Tables\Columns\TextColumn::make('instructions')
                    ->html()
                    ->label('Instructions'),
            ])
            ->prependBulkActions([
                Tables\Actions\BulkAction::make('Download')
                    ->action(fn (Collection $records) => redirect(route('prescription.download', ($records->first())->id)))
                    ->color('success')
                    ->icon('heroicon-o-download'),
            ])
            ->filters([
                //
            ]);
    }
}
