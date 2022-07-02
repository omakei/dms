<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Filament\Resources\PatientResource\Widgets\PatientOverview;
use App\Models\Country;
use App\Models\District;
use App\Models\Patient;
use App\Models\Region;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Patient Care';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema(Forms\Components\Card::class))
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('patient_number')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('full_name')->sortable()->searchable(['first_name','middle_name', 'last_name']),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('insurance_type'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VitalSignsRelationManager::class,
            RelationManagers\MedicalHistoriesRelationManager::class,
            RelationManagers\ComplaintHistoriesRelationManager::class,
            RelationManagers\BirthHistoriesRelationManager::class,
            RelationManagers\SocialHistoriesRelationManager::class,
            RelationManagers\GynaecologicalHistoriesRelationManager::class,
            RelationManagers\SystemReviewHistoriesRelationManager::class,
            RelationManagers\DiagnosesRelationManager::class,
            RelationManagers\InvestigationsRelationManager::class,
            RelationManagers\PrescriptionsRelationManager::class,
            RelationManagers\ReferralsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
            'view' => Pages\ViewPatient::route('/{record}'),
        ];
    }



    public static function getFormSchema(string $layout = Forms\Components\Grid::class): array
    {
        return [
            Forms\Components\Group::make()
                ->schema([
                    $layout::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Personal Information'),
                            Forms\Components\Grid::make()
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
                            Forms\Components\TextInput::make('tribe')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\DatePicker::make('dob')
                                ->default(now())
                                ->required(),
                            Forms\Components\TextInput::make('patient_number')
                                ->required()
                                ->disabled()
                                ->default('DIT-P-'.now()->year.'-'.rand(111,999))
                                ->maxLength(255),
                        ])
                        ])->columns([
                            'sm' => 3,
                        ]),
                    $layout::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Address Information'),
                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\Select::make('country_id')
                                        ->label('country')
                                        ->required()
                                        ->searchable()
                                        ->options(Country::all()->pluck('name','id')),
                                    Forms\Components\Select::make('region_id')
                                    ->label('region')
                                    ->searchable()
                                    ->options(Region::all()->pluck('name','id')),
                                    Forms\Components\Select::make('district_id')
                                        ->label('district')
                                        ->searchable()
                                        ->options(District::all()->pluck('name','id')),

                                ])
                        ])
                        ->columns([
                            'sm' => 3,
                        ]),
                    $layout::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Insurance Information'),

                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\Select::make('insurance_type')
                                        ->options([
                                            'NHIF' => 'NHIF',
                                            'Other' => 'Other',
                                            'None' => 'None',
                                        ]),
                                    Forms\Components\TextInput::make('insurance_number')
                                        ->maxLength(255),
                                ]),
                        ]),
                    $layout::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Next Of Kin Information'),

                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\TextInput::make('next_of_kin_name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('next_of_kin_phone')
                                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{255}(000)000-00-00'))
                                        ->tel()
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\Select::make('next_of_kin_relationship')
                                        ->required()
                                        ->options([
                                            'Further' => 'Further',
                                            'Mother' => 'Mother',
                                            'Guardian' => 'Guardian',
                                            'Child' => 'Child',
                                            'Brother' => 'Brother',
                                            'Sister' => 'Sister',
                                            'Other' => 'Other',
                                        ]),
                                ]),
                        ]),

                    $layout::make()
                        ->schema([
                            Forms\Components\Placeholder::make('Contact Information'),
                            Forms\Components\Grid::make()
                                ->schema([
                                    Forms\Components\TextInput::make('address')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('email')
                                        ->email()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('phone')
                                        ->mask(fn (Forms\Components\TextInput\Mask $mask) => $mask->pattern('+{255}(000)000-00-00'))
                                        ->tel()
                                        ->required()
                                        ->maxLength(255),
                                    ])
                        ])
                        ->columns([
                            'sm' => 3,
                        ]),
                ])->columnSpan([
                    'sm' => 3,
                ]),
        ];
    }

}
