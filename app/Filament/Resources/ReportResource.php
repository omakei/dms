<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Patient Care';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('from')
                    ->required()
                    ->default(now()),
                Forms\Components\DatePicker::make('to')
                    ->required()
                    ->default(now()),
                Forms\Components\Select::make('type')
                    ->required()
                    ->options([
                        'mtuha book 7' => 'mtuha book 7'
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('from')->date(),
                Tables\Columns\TextColumn::make('to')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
            ])
            ->prependActions([
                auth()->user()->hasRole('laboratory')?
                    Tables\Actions\LinkAction::make('Report')
                        ->url(fn (Report $record) => route('mtuha.download', $record->id))
                        ->icon('heroicon-o-download')
                        ->color('primary'):Tables\Actions\LinkAction::make('Report')
                    ->url(fn (Report $record) => route('mtuha.download', $record->id))
                    ->icon('heroicon-o-download')
                    ->color('primary')
                ,
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
