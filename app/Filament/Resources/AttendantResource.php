<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendantResource\Pages;
use App\Filament\Resources\AttendantResource\RelationManagers;
use App\Models\Attendant;
use App\Models\Department;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class AttendantResource extends Resource
{
    protected static ?string $model = Attendant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('middle_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female'
                    ]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{255}(000)000-00-00'))
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('profile_category')
                    ->required()
                    ->options([
                        'Doctor' => 'Doctor',
                        'Nurse' => 'Nurse',
                        'Lab Technician' => 'Lab Technician',
                        'Pharmacist' => 'Pharmacist',
                    ]),
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name','id'))
                    ->required(),
                Forms\Components\Select::make('department_id')
                    ->label('Department')
                    ->options(Department::all()->pluck('name','id'))
                    ->required(),
                Forms\Components\Textarea::make('specializations')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->sortable()->searchable(['first_name','middle_name', 'last_name']),
                Tables\Columns\TextColumn::make('department.name'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('profile_category'),
                Tables\Columns\TextColumn::make('specializations'),
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
            'index' => Pages\ListAttendants::route('/'),
            'create' => Pages\CreateAttendant::route('/create'),
            'edit' => Pages\EditAttendant::route('/{record}/edit'),
            'view' => Pages\ViewAttendant::route('/{record}'),
        ];
    }
}
