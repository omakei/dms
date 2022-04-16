<?php

namespace App\Filament\Resources\PatientVisitResource\RelationManagers;

use App\Models\PatientReferral;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class ReferralsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'referrals';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('referral_type')
                    ->label('Referral type')
                    ->required()
                    ->options([
                        'Routine' => 'Routine',
                        'Emergency' => 'Emergency',
                        'Opportunistic' => 'Opportunistic',
                    ]),
                Forms\Components\TextInput::make('hospital_name')
                    ->maxLength(255),
                Forms\Components\RichEditor::make('patient_examination')
                    ->label('Patient examination')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
                Forms\Components\RichEditor::make('treatment_given')
                    ->label('Treatment given')
                    ->disableAllToolbarButtons()
                    ->enableToolbarButtons([
                        'bold',
                        'bulletList',
                        'italic',
                        'strike',
                    ]),
                Forms\Components\RichEditor::make('reason_for_referral')
                    ->label('Reason for referral')
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
                Tables\Columns\TextColumn::make('referral_type')
                    ->label('Referral type'),
                Tables\Columns\TextColumn::make('hospital_name')
                    ->label('Hospital'),
                Tables\Columns\TextColumn::make('patient_examination')
                    ->html()
                    ->label('Patient examination'),
                Tables\Columns\TextColumn::make('treatment_given')
                    ->html()
                    ->label('Treatment given'),
                Tables\Columns\TextColumn::make('reason_for_referral')
                    ->html()
                    ->label('Reason for referral'),
            ])
            ->prependActions([
                    Tables\Actions\LinkAction::make('Referral')
                        ->url(fn (PatientReferral $record) => route('referral.download', $record->id))
                        ->icon('heroicon-o-download')
                        ->color('primary'),
            ])
            ->filters([
                //
            ]);
    }
}
