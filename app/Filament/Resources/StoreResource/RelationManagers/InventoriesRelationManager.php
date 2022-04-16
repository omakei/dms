<?php

namespace App\Filament\Resources\StoreResource\RelationManagers;

use App\Models\Medicine;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class InventoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'inventories';

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
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('medicine.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ]);
    }
}
