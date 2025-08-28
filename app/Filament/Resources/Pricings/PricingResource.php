<?php

namespace App\Filament\Resources\Pricings;

use App\Filament\Resources\Pricings\Pages\CreatePricing;
use App\Filament\Resources\Pricings\Pages\EditPricing;
use App\Filament\Resources\Pricings\Pages\ListPricings;
use App\Filament\Resources\Pricings\Pages\ViewPricing;
use App\Filament\Resources\Pricings\Schemas\PricingForm;
use App\Filament\Resources\Pricings\Schemas\PricingInfolist;
use App\Filament\Resources\Pricings\Tables\PricingsTable;
use App\Models\Pricing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PricingResource extends Resource
{
    protected static ?string $model = Pricing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CurrencyDollar;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PricingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PricingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PricingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPricings::route('/'),
            'create' => CreatePricing::route('/create'),
            'view' => ViewPricing::route('/{record}'),
            'edit' => EditPricing::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
