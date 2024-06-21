<?php

namespace App\Http\Controllers;

use App\Models\TransactionUser;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TransactionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function downloadReport(TransactionUser $transaction_user)
    {
        $user = Auth::user();

        $transaction_user->load('transaction.property', 'user');

        $transaction_user = $transaction_user->toArray();

        $report_name = 'report_' . preg_replace('/\s+/', '', now()->toDateTimeString()) . '.pdf';

        $pdf = Pdf::loadView('transaction-users.report', compact('transaction_user', 'report_name', 'user'))->setPaper('a4', 'landscape');
        return $pdf->download($report_name);
        
        // return view('transaction-users.report', compact('transaction_user', 'report_name', 'user'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionUser $transactionUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionUser $transactionUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionUser $transactionUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionUser $transactionUser)
    {
        //
    }
}
