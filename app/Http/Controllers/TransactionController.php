<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Client;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display the list of Transactions
     */
    public function index()
    {
        // Get 10 transactions per page
        $transactions = Transaction::latest()->paginate(10);
        
        return view('transactions.index',compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for adding a new transaction.
     */
    public function create()
    {
        $clients_list = Client::all()->toArray();

        return view('transactions.create',compact('clients_list'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'client' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        //Get date and time
        $date = Carbon::now();
        $dateTime = $date->toDateTimeString();

        // Save data to db.
        $transaction = new Transaction();
        $transaction ->client = $request->input('client');
        $transaction ->transaction_date = $dateTime;
        $transaction ->amount = $request->input('amount');
        $transaction ->save();

        return redirect()->route('transactions.index')
            ->with('success','Transactions created successfully.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show',compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit',compact('transaction'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //validation
        $request->validate([
            'client' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')
            ->with('success','Transaction updated successfully');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->back()
            ->with('success','Transaction deleted successfully');
    }
}
