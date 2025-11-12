<?php

namespace App\Livewire\Transaction;

use App\Models\Transactions as TransactionsModel;
use Livewire\Component;

class Transactions extends Component
{
    public function render()
    {
        $transactions = TransactionsModel::with(['user', 'payment'])
            ->get();

        return view('livewire.transaction.transactions', [
            'transactions' => $transactions
        ]);
    }
}
