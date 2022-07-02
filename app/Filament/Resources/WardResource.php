<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WardResource\Pages;
use App\Filament\Resources\WardResource\RelationManagers;
use App\Models\Ward;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class WardResource extends Resource
{
    protected static ?string $model = Ward::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    protected static ?string $navigationGroup = 'Observation';

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
            RelationManagers\BedsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWards::route('/'),
            'create' => Pages\CreateWard::route('/create'),
            'edit' => Pages\EditWard::route('/{record}/edit'),
            'view' => Pages\ViewWard::route('/{record}'),
        ];
    }
}
