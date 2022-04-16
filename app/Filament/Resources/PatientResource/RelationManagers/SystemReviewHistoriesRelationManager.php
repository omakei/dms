<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class SystemReviewHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'system_review_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'System review histories';

    protected static ?string $label = 'System review history';

    protected static ?string $pluralLabel = 'System review histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('musculoskeletal')
                    ->label('musculoskeletal')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('respiratory')
                    ->label('respiratory')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('cardiovascular')
                    ->label('cardiovascular')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('gastrointestinal')
                    ->label('gastrointestinal')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('genitourinary')
                    ->label('genitourinary')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('central_nervous')
                    ->label('central_nervous')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('endocrine')
                    ->label('endocrine')
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
                Tables\Columns\TextColumn::make('musculoskeletal')
                    ->label('Musculoskeletal')
                    ->html(),
                Tables\Columns\TextColumn::make('respiratory')
                    ->label('Respiratory')
                    ->html(),
                Tables\Columns\TextColumn::make('cardiovascular')
                    ->label('Cardiovascular')
                    ->html(),
                Tables\Columns\TextColumn::make('gastrointestinal')
                    ->label('Gastrointestinal')
                    ->html(),
                Tables\Columns\TextColumn::make('genitourinary')
                    ->label('Genitourinary')
                    ->html(),
                Tables\Columns\TextColumn::make('central_nervous')
                    ->label('Central nervous')
                    ->html(),
                Tables\Columns\TextColumn::make('endocrine')
                    ->label('Endocrine')
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }
}
