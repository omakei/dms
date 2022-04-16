<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SocialHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'social_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Social histories';

    protected static ?string $label = 'Social history';

    protected static ?string $pluralLabel = 'Social histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('chronic_illness_in_the_family')
                    ->label('chronic illness in the family')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('substance_abuse')
                    ->label('substance abuse')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('adoption')
                    ->label('adoption')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('other')
                    ->label('other')
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
                Tables\Columns\TextColumn::make('chronic_illness_in_the_family')
                    ->label('Chronic illness in the family')
                    ->html(),
                Tables\Columns\TextColumn::make('substance_abuse')
                    ->label('Substance abuse')
                    ->html(),
                Tables\Columns\TextColumn::make('adoption')
                    ->label('Adoption')
                    ->html(),
                Tables\Columns\TextColumn::make('other')
                    ->label('Other')
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }
}
