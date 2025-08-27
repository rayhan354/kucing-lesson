<?php

namespace App\Filament\Resources\SectionContents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SectionContentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('courseSection.name'),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
