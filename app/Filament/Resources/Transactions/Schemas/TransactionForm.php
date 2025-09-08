<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Pricing;
use App\Models\Transaction;
use App\Models\User;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make('Product and Price')
                        ->schema([
                            Grid::make(2)
                                ->schema([

                                    Forms\Components\Select::make('pricing_id')
                                    ->relationship('pricing', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $pricing = Pricing::find($state); // get the pricing information

                                        $price = $pricing->price; // get the price
                                        $duration = $pricing->duration; // get the duration

                                        $subTotal = $price * $state; // get the sub total
                                        $totalPpn = $subTotal * 0.11; // get the total ppn
                                        $totalAmount = $subTotal + $totalPpn; // get the total amount

                                        $set('total_tax_amount', $totalPpn);
                                        $set('grand_total_amount', $totalAmount);
                                        $set('sub_total_amount', $price);
                                        $set('duration', $duration);
                                    })
                                    ->afterStateHydrated(function (callable $set, $state) {
                                        $pricingId = $state;
                                        if ($pricingId) {
                                            $pricing = Pricing::find($pricingId);
                                            $duration = $pricing->duration;
                                            $set('duration', $duration);
                                        }
                                    }),

                                    Forms\Components\TextInput::make('duration')
                                    ->required()
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Months'),

                            ]),

                            Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('sub_total_amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->readOnly(),

                                Forms\Components\TextInput::make('total_tax_amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->readOnly(),

                                Forms\Components\TextInput::make('grand_total_amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->readOnly()
                                    ->helperText('Harga sudah include PPN 11%'),
                            ]),


                            Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('started_at')
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    $duration = $get('duration'); // Get the duration from the form state
                                    if ($state && $duration) {
                                        $endedAt = \Carbon\Carbon::parse($state)->addMonth($duration); // Calculate the end date
                                        $set('ended_at', $endedAt->format('Y-m-d')); // Set the calculated end date
                                    }
                                })
                                ->required(),

                                Forms\Components\DatePicker::make('ended_at')
                                ->readOnly()
                                ->required(),

                            ]),
                        ]),

                        Step::make('Customer Information')
                        ->schema([
                            Forms\Components\Select::make('user_id')
                                ->relationship('student', 'email')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $user = User::find($state);

                                    $name = $user->name;
                                    $email = $user->email;

                                    $set('name', $name);
                                    $set('email', $email);
                                })
                                ->afterStateHydrated(function (callable $set, $state) {
                                    $userId = $state;
                                    if ($userId) {
                                        $user = User::find($userId);
                                        $name = $user->name;
                                        $email = $user->email;
                                        $set('name', $name);
                                        $set('email', $email);
                                    }
                                }),
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->readOnly()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('email')
                                ->required()
                                ->readOnly()
                                ->maxLength(255),
                        ]),


                    Step::make('Payment Information')
                        ->schema([

                            ToggleButtons::make('is_paid')
                                ->label('Apakah sudah membayar?')
                                ->boolean()
                                ->grouped()
                                ->icons([
                                    true => 'heroicon-o-pencil',
                                    false => 'heroicon-o-clock',
                                ])
                                ->required(),

                            Forms\Components\Select::make('payment_type')
                                ->options([
                                    'Midtrans' => 'Midtrans',
                                    'Manual' => 'Manual',
                                ])
                                ->required(),

                            Forms\Components\FileUpload::make('proof')
                                ->image(),
                        ]),

                ])
                ->columnSpan('full') // Use full width for the wizard
                ->columns(1) // Make sure the form has a single column layout
                ->skippable()
            ]);
    }
}
