<?php

namespace App\Filament\Resources\SectionContents\Pages;

use App\Filament\Resources\SectionContents\SectionContentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSectionContent extends ViewRecord
{
    protected static string $resource = SectionContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
