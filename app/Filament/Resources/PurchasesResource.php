<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchasesResource\Pages;
use App\Filament\Resources\PurchasesResource\RelationManagers;
use App\Models\Medicine;
use App\Models\Purchases;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PurchasesResource extends Resource
{
    protected static ?string $model = Purchases::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

    protected static ?string $navigationGroup = 'Pharmacy';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('purchases_reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('medicine_id')
                    ->label('Medicine')
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $searchQuery) => Medicine::where('name', 'like', "%{$searchQuery}%")
                        ->orWhere('manufacture', 'like', "%{$searchQuery}%")->limit(50)->pluck('name', 'id'))
                    ->getOptionLabelUsing(fn ($value): ?string => (Medicine::find($value)?->name ))
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('cost')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('expired_at')
                    ->required()
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('purchases_reference')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('medicine.name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('cost')->money('TZS',true),
                Tables\Columns\TextColumn::make('expired_at')->date(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchases::route('/create'),
            'edit' => Pages\EditPurchases::route('/{record}/edit'),
        ];
    }
}
