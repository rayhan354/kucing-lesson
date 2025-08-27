<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('booking_trx_id'),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('pricing_id')
                    ->numeric(),
                TextEntry::make('sub_total_amount')
                    ->numeric(),
                TextEntry::make('grand_total_amount')
                    ->numeric(),
                TextEntry::make('total_tax_amount')
                    ->numeric(),
                IconEntry::make('is_paid')
                    ->boolean(),
                TextEntry::make('payment_type'),
                TextEntry::make('proof'),
                TextEntry::make('started_at')
                    ->date(),
                TextEntry::make('ended_at')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
