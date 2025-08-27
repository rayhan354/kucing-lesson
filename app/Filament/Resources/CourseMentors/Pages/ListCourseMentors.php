<?php

namespace App\Filament\Resources\CourseMentors\Pages;

use App\Filament\Resources\CourseMentors\CourseMentorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourseMentors extends ListRecords
{
    protected static string $resource = CourseMentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
