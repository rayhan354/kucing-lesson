<?php

namespace App\Helpers;

use App\Models\Transaction;

class TransactionHelper
{
    public static function generateUniqueTrxId(): string
    {
        $prefix = 'TEST123_';
        do {
            $randomString = $prefix . mt_rand(1, 99999); // OBITOBWA1293918
        } while (Transaction::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }
}
