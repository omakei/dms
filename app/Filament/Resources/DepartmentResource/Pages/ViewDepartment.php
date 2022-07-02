<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\AttendantResource;
use App\Filament\Resources\DepartmentResource;
use App\Models\Department;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartment extends ViewRecord
{
    protected static string $resource = DepartmentResource::class;
}
