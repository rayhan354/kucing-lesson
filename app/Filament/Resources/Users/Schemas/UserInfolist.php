<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('email_verified_at')
                    ->dateTime(),
                TextEntry::make('roles.name')  // Use custom TagsEntry for roles
                   ->label('Roles')
                   ->badge()
                   ->color('primary')  // Makes badges orange-like; adjust as needed
                   ->placeholder('No roles'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                    TextEntry::make('occupation')  // Added
                    ->label('Occupation'),
                ImageEntry::make('photo')  // Added for photo display
                    ->label('Photo')
                    ->disk('public')  // Assumes public storage
                    ->url(fn ($record): string => asset('storage/' . $record->photo))  // Forces full URL
                    ->size(150),  // Thumbnail size
            ]);
    }
}
