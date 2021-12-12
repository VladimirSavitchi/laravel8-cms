@extends('layouts.layout')

@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Transactions</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('transactions.create') }}">Add transaction</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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

    {!! $transactions->links() !!}

@endsection