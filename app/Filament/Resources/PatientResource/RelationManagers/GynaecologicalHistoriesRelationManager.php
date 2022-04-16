<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class GynaecologicalHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'gynaecological_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Gynaecological histories';

    protected static ?string $label = 'Gynaecological history';

    protected static ?string $pluralLabel = 'Gynaecological histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('menarche')
                    ->maxLength(255),
                Forms\Components\TextInput::make('menopause')
                    ->maxLength(255),
                Forms\Components\TextInput::make('menstrual_cycles')
                    ->maxLength(255),
                Forms\Components\TextInput::make('frequency_of_changing_pads')
                    ->maxLength(255),
                Forms\Components\TextInput::make('recurrent_menstruation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('contraceptive')
                    ->maxLength(255),
                Forms\Components\TextInput::make('pregnancy')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lnmp')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gravidity')
                    ->maxLength(255),
                Forms\Components\TextInput::make('parity')
                    ->maxLength(255),
                Forms\Components\TextInput::make('children')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('menarche'),
                Tables\Columns\TextColumn::make('menopause'),
                Tables\Columns\TextColumn::make('menstrual_cycles'),
                Tables\Columns\TextColumn::make('frequency_of_changing_pads'),
                Tables\Columns\TextColumn::make('recurrent_menstruation'),
                Tables\Columns\TextColumn::make('contraceptive'),
                Tables\Columns\TextColumn::make('pregnancy'),
                Tables\Columns\TextColumn::make('lnmp'),
                Tables\Columns\TextColumn::make('gravidity'),
                Tables\Columns\TextColumn::make('parity'),
                Tables\Columns\TextColumn::make('children'),
            ])
            ->filters([
                //
            ]);
    }
}
