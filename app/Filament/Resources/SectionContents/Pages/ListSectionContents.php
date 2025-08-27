<?php

namespace App\Filament\Resources\SectionContents\Pages;

use App\Filament\Resources\SectionContents\SectionContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSectionContents extends ListRecords
{
    protected static string $resource = SectionContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
