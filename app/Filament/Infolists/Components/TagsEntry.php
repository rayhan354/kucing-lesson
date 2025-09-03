<?php

namespace App\Filament\Infolists\Components;

use Filament\Infolists\Components\Entry;

class TagsEntry extends Entry
{
    protected string $view = 'filament.infolists.components.tags-entry';

    // Optional state processing (e.g., for roles.name relationship)
    public function getState(): mixed
    {
        $state = parent::getState();

        if ($state instanceof \Illuminate\Support\Collection) {
            $state = $state->pluck('name')->toArray();  // Extract role names
        }

        return is_array($state) ? $state : (array) $state;
    }
}