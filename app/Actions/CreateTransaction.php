<?php

namespace App\Actions;

use App\Models\Transaction;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTransactionRequest;

class CreateTransaction
{
    public function handle(StoreTransactionRequest $request) : Transaction
    {
        $user = Auth::user();

        $transaction = Transaction::create([
            'kid_id' => $request['kid'],
            'type' => $request['type'],
            'amount' => $request['amount'],
            'date' => $request['date'],
            'note' => $request['note'],
            'user_id' => $user->id,
        ]);

        return $transaction;
    }
}