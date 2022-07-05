<?php

namespace App\Filament\Resources\PatientVisitResource\RelationManagers;

use App\Models\LaboratoryTest;
use App\Models\PatientInvestigation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\Component;

class InvestigationsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'investigations';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Investigations';

    protected static ?string $label = 'Investigation';

    protected static ?string $pluralLabel = 'Investigations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('state')
                    ->label('State')
                    ->required()
                    ->options([
                        'Pending' => 'Pending',
                        'Send' => 'Send To Lab',
                    ]),
                Forms\Components\Select::make('laboratory_test_id')
                    ->label('Laboratory test')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => LaboratoryTest::where('name', 'like', "%{$searchQuery}%")
                        ->orWhere('code', 'like', "%{$searchQuery}%")->limit(50)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (LaboratoryTest::find($value)?->name ))
                    ->required(),
                Forms\Components\RichEditor::make('results')
                    ->label('Test Results')
                    ->visible(fn (Component $livewire): bool =>(auth()->user()->hasRole('laboratory')))
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
                Forms\Components\Toggle::make('result_is_published')
                    ->label('Publish Result')
                    ->visible(fn (Component $livewire): bool =>(auth()->user()->hasRole('laboratory')))
                    ->inline(false)
                    ,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('laboratory_test.name')
                    ->label('Test'),
                Tables\Columns\TextColumn::make('state'),
                Tables\Columns\TextColumn::make('results')
                    ->html()
                    ->label('Results'),
                Tables\Columns\BooleanColumn::make('result_is_published')
                    ->label('Publication Status'),
//                Tables\Columns\TextColumn::make('publisher.name')
//                    ->label('Publisher'),

            ])

            ->prependActions([
                auth()->user()->hasRole('laboratory')?
                Tables\Actions\LinkAction::make('sample label')
                    ->url(fn (PatientInvestigation $record) => route('label.download', $record->id))
                    ->icon('heroicon-o-download')
                    ->color('primary'):Tables\Actions\LinkAction::make('')
                    ,
            ])
            ->filters([
                //
            ]);
    }
}
