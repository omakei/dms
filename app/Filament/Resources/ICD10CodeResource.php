<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ICD10CodeResource\Pages;
use App\Filament\Resources\ICD10CodeResource\RelationManagers;
use App\Models\ICD10Code;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ICD10CodeResource extends Resource
{
    protected static ?string $model = ICD10Code::class;

    protected static ?string $navigationIcon = 'heroicon-o-table';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('code')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('description')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
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
            'index' => Pages\ListICD10Codes::route('/'),
            'create' => Pages\CreateICD10Code::route('/create'),
            'edit' => Pages\EditICD10Code::route('/{record}/edit'),
        ];
    }
}
