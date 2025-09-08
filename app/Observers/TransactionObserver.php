<?php

namespace App\Observers;

use App\Helpers\TransactionHelper;
use App\Models\Transaction;

class TransactionObserver
{
    //

    public function creating($transaction)
    {
        $transaction->booking_trx_id = TransactionHelper::generateUniqueTrxId();
    }


    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        //
        //if transaction created successfully then update transaction status to pending
        // or generate booking transaction id
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
