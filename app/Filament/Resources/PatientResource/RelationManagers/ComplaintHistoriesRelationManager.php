<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ComplaintHistoriesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'complaint_histories';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Complaint histories';

    protected static ?string $label = 'Complaint history';

    protected static ?string $pluralLabel = 'Complaint histories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\RichEditor::make('chief_complaint')
                    ->label('chief complaint')
                    ->required()
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
                Forms\Components\RichEditor::make('other_complaint')
                    ->label('other complaint')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
                Forms\Components\RichEditor::make('history_of_presenting_illness')
                    ->label('history of presenting illness')
                    ->required()
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('chief_complaint')
                    ->label('Chief complaint')
                    ->html(),
                Tables\Columns\TextColumn::make('other_complaint')
                    ->label('Other complaint')
                    ->html(),
                Tables\Columns\TextColumn::make('history_of_presenting_illness')
                    ->label('History of presenting illness')
                    ->html(),
            ])
            ->filters([
                //
            ]);
    }
}
