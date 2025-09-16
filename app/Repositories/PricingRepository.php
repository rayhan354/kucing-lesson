<?php

namespace App\Repositories;

use App\Models\Pricing;
use Illuminate\Support\Collection;

use App\Repositories\PricingRepositoryInterface; // Import the interface

class PricingRepository implements PricingRepositoryInterface
{
    public function findById(int $id): ?Pricing
    {
        return Pricing::find($id);
    }

    public function getAll(): Collection
    {
        return Pricing::all();
    }

    public function getPricing() {
        // Example logic
        return 'Pricing data';
    }

}
