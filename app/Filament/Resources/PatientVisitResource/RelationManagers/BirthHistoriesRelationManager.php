<?php

namespace App\Filament\Resources\PatientVisitResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class BirthHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'birth_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Birth histories';

    protected static ?string $label = 'Birth history';

    protected static ?string $pluralLabel = 'Birth histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('antenatal')
                    ->label('antenatal')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('natal')
                    ->label('natal')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('postnatal')
                    ->label('postnatal')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('nutrition')
                    ->label('nutrition')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('growth')
                    ->label('growth')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('development')
                    ->label('development')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('antenatal')
                    ->label('Antenatal')
                    ->html(),
                Tables\Columns\TextColumn::make('natal')
                    ->label('Natal')
                    ->html(),
                Tables\Columns\TextColumn::make('postnatal')
                    ->label('Postnatal')
                    ->html(),
                Tables\Columns\TextColumn::make('nutrition')
                    ->label('Nutrition')
                    ->html(),
                Tables\Columns\TextColumn::make('growth')
                    ->label('Growth')
                    ->html(),
                Tables\Columns\TextColumn::make('development')
                    ->label('Development')
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }
}
