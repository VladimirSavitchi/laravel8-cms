<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Transaction;

class ClientController extends Controller
{
    /**
     * Display the list of clients
     */
    public function index()
    {
        // view 10 clients per page
        $clients = Client::latest()->paginate(10);

        return view('clients.index',compact('clients'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for adding a new client.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Save a newly created client.
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'first_name' => 'required|string|alpha_num|max:150|min:3',
            'last_name' => 'required|string|alpha_num|max:150|min:3',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'email' => 'required|email|max:250|min:3',
        ]);

        // upload img to storage
        $avatar=$request->file('avatar');
        $filename = time().'.'.$avatar->getClientOriginalExtension();
        $request->file('avatar')->move('storage/img/pfp', $filename);

        // store client details
        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name =  $request->input('last_name');
        $client->avatar = $filename;
        $client->email = $request->input('email');
        $client->save();

        return redirect()->route('clients.index')
            ->with('success','Client created successfully.');
    }

    /**
     * Display the specified client.
     */
    public function show(Client $client)
    {
        $transactions = Transaction::where('client', $client->id)->get();
        
        return view('clients.show',compact('client','transactions'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified client.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'first_name' => 'required|string|alpha_num|max:150|min:3',
            'last_name' => 'required|string|alpha_num|max:150|min:3',
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'email' => 'required|email|max:250|min:3',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success','Client updated successfully');
    }

    /**
     * Remove the specified client.
     */
    public function destroy(Client $client)
    {
        dd($client->avatar);
        //unlink("uploads/".$image->image_name);
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success','Client deleted successfully');
    }
}
