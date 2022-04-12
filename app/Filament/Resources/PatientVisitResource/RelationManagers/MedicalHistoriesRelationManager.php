<?php

namespace App\Filament\Resources\PatientVisitResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class MedicalHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'medical_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Medical histories';

    protected static ?string $label = 'Medical history';

    protected static ?string $pluralLabel = 'Medical histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('allergies')
                    ->label('allergies')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('medication')
                    ->label('medication')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('illness')
                    ->label('illness')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('admission')
                    ->label('admission')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bulletList',
                    ]),
                Forms\Components\RichEditor::make('immunisation')
                    ->label('immunisation')
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
                Tables\Columns\TextColumn::make('allergies')
                    ->label('Allergies')
                    ->html(),
                Tables\Columns\TextColumn::make('medication')
                    ->label('Medication')
                    ->html(),
                Tables\Columns\TextColumn::make('illness')
                    ->label('Illness')
                    ->html(),
                Tables\Columns\TextColumn::make('admission')
                    ->label('Admission')
                    ->html(),
                Tables\Columns\TextColumn::make('immunisation')
                    ->label('Immunisation')
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }
}
