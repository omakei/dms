<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Spatie\Permission\Models\Role;

class RolesRelationManager extends MorphToManyRelationManager
{
    protected static string $relationship = 'roles';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ]);
    }

    public static function attachForm(Form $form): Form
    {
        return $form
            ->schema([
                static::getAttachFormRecordSelect(),
//                Forms\Components\Select::make('role')
//                    ->options(Role::all()->pluck('name','id'))
//                    ->required(),
                // ...
            ]);
    }

    public static function getAttachFormRecordSelect(): Forms\Components\Select
    {
        return Forms\Components\Select::make('recordId')
            ->label('Allowance')
            ->options(Role::all()->pluck('name', 'id'))
            ->searchable();
    }
}
