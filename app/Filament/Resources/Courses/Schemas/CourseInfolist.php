<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class CourseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug'),
                TextEntry::make('name'),
                ImageEntry::make('thumbnail')
                ->label('Photo')
                ->disk('public')  // Assumes public storage
                ->url(fn ($record): string => asset('storage/' . $record->photo))  // Forces full URL
                ->size(150),  // Thumbnail size
                IconEntry::make('is_popular')
                    ->boolean(),
                TextEntry::make('category.name'),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
