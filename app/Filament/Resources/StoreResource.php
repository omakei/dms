<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Models\Store;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Pharmacy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->html(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\InventoriesRelationManager::class,
            RelationManagers\SalesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
            'view' => Pages\ViewStore::route('/{record}'),
        ];
    }
}
