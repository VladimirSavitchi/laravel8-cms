@extends('layouts.layout')

@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Show client</h3>
                <a href="{{ route('clients.index') }}" class="btn btn-info">Back</a>
            </div>
        </div>
    </div>
    <table style="width:100%">
        <tr>
            <td width="180px"><img class="object-cover w-full h-full rounded-full" src="{{asset($client->avatar)}}" alt="" loading="lazy" /></td>
            <td>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        {{ $client->first_name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        {{ $client->last_name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $client->email }}
                    </div>
                </div>
            </div>
            </td>
        </tr>
    </table>

    <div class="row mt-20" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Transactions</h3>
            </div>
        </div>
    </div>

    
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Amount</th>
            <th>Date </th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($transactions as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{ $transaction->client }}</td>
                <td>{{ $transaction->amount }}</td> 
                <td> {{ $transaction->transaction_date }}</td>
                <td>
                    <form action="{{ route('transactions.destroy',$transaction->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('transactions.show',$transaction->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection