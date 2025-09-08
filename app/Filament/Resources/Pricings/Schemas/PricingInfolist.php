<?php

namespace App\Filament\Resources\Pricings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PricingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('duration')
                    ->numeric(),
                TextEntry::make('price')
                    ->money('IDR'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
