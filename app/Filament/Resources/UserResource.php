<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                ->dehydrateStateUsing(fn(string $state)=> filled($state) ? Hash::make($state): null)
                ->dehydrated(fn($state)=> filled($state)),

                Forms\Components\MultiSelect::make('roles')
                    ->required()
                    ->options(Role::all()->pluck('name','id'))
                    ->default(1)
                    ->hidden(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser)
                    ->reactive()
                    ->afterStateUpdated(fn ($state, User $record) => ($record->syncRoles($state))),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


}
