<?php

namespace App\Filament\Resources\CourseMentors\Pages;

use App\Filament\Resources\CourseMentors\CourseMentorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCourseMentor extends ViewRecord
{
    protected static string $resource = CourseMentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
