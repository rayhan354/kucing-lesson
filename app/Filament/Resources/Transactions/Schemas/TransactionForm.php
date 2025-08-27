<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('booking_trx_id')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('pricing_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sub_total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('grand_total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('total_tax_amount')
                    ->required()
                    ->numeric(),
                Toggle::make('is_paid')
                    ->required(),
                TextInput::make('payment_type')
                    ->required(),
                TextInput::make('proof'),
                DatePicker::make('started_at')
                    ->required(),
                DatePicker::make('ended_at')
                    ->required(),
            ]);
    }
}
