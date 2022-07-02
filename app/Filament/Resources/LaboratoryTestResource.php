<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaboratoryTestResource\Pages;
use App\Filament\Resources\LaboratoryTestResource\RelationManagers;
use App\Models\LaboratoryTest;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class LaboratoryTestResource extends Resource
{
    protected static ?string $model = LaboratoryTest::class;

    protected static ?string $navigationIcon = 'heroicon-o-search-circle';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')->numeric(),
                Forms\Components\Textarea::make('sample_type')
                    ->maxLength(65535),
                Forms\Components\Textarea::make('sample_type_description')
                    ->maxLength(65535),
                Forms\Components\Textarea::make('container_description')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('code'),
                Tables\Columns\TextColumn::make('price')->money('TZS',true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLaboratoryTests::route('/'),
            'create' => Pages\CreateLaboratoryTest::route('/create'),
            'edit' => Pages\EditLaboratoryTest::route('/{record}/edit'),
            'view' => Pages\ViewLaboratoryTest::route('/{record}'),
        ];
    }
}
