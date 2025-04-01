<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : Response
    {
        $user = $request->user();
        $kid = null;
        $transactions = [];

        if(!empty($request->query('kid'))) {
            if(empty($request->query('search'))) {
                $transactions = Transaction::viewable($user, $kid)
                    ->orderBy('name', 'ASC')
                    ->paginate(10);
            } else {
                $transactions = Transaction::viewable($user, $kid)
                    ->where('note', 'LIKE', '%' . $request->query('search') . '%')
                    ->orderBy('note', 'ASC')
                    ->paginate(10);
            }
        }
        
        return Inertia::render('Transactions/Index', [
            'transactions' => $transactions,
            'user' => $user,
            'kid' => $kid,
            'search' => $request->query('search'),
            'successMessage' => $request->query('successMessage'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
