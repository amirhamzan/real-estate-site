<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\TransactionUser;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('property')->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $properties = Property::doesntHave('transaction')->get();

        $users = User::where('id', '!=', 1)->get();

        return view('transactions.create', compact('properties', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $validate = $request->validated();

        $transaction = Transaction::create([
            'property_id' => $validate['property_id'],
            'price' => $validate['price']
        ]);

        $transaction_users_arr = [];

        foreach ($validate['commissions'] as $index => $commission) {

            $trans_user_to_be_addedd = [
                "transaction_id" => $transaction->id,
                "user_id" => $index,
                "percentage" => $commission,
                "commission" => $commission / 100 * $transaction->price,
            ];

            array_push($transaction_users_arr, $trans_user_to_be_addedd);
        }

        TransactionUser::insert($transaction_users_arr);

        return redirect()->route('transactions.index')->with('success', "Transaction successfully added");
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('property', 'transactionUsers.user',);

        $total_percentage = $transaction->transactionUsers->sum('percentage');
        $total_commission = $transaction->transactionUsers->sum('commission');

        return view('transactions.show', compact('transaction', 'total_percentage', 'total_commission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
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
