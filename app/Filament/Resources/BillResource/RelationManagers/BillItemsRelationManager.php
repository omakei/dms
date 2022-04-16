<?php

namespace App\Filament\Resources\BillResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BillItemsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'bill_items';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Bill items';

    protected static ?string $label = 'Bill item';

    protected static ?string $pluralLabel = 'Bill items';

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
                Tables\Columns\TextColumn::make('billable.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('billable.price')->money('TZS',true),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ]);
    }
}
