<?php

namespace App\Http\Controllers;

use App\Models\Kid;
use App\Actions\CreateTransaction;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : Response
    {
        $user = $request->user();
        $kid = null;
        $transactions = Transaction::query();

        if(!empty($request->query('kid'))) {
            try {
                $kid = Kid::viewable($request->user())
                    ->findOrFail($request->query('kid'));
            } catch (ModelNotFoundException $e) {
                abort(404);
            }

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
            'kids' => Kid::viewable($user)->get(),
            'search' => $request->query('search') ?? '',
            'successMessage' => $request->query('successMessage'),
        ]);
    }

    /**
     * Show the form for creating a new resource.\
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) : Response
    {
        return Inertia::render('Transactions/Create', [
            'kids' => Kid::viewable($request->user())->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $action = new CreateTransaction();
        $action->handle($request);
        
        return to_route('transactions.index', [
            'successMessage' => 'Transaction created successfully.',
        ]);
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
