@extends('layouts.layout')

@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Clients</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('clients.create') }}">Add Client</a>
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
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($clients as $client) 
            <tr>
                <td width="80px"><img class="object-cover w-full h-full rounded-full" src="{{Storage :: url ($client->avatar)}}" alt="" loading="lazy" /></td>
                <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">Edit</a>
                    <button type="button" class="btn btn-danger" onclick="openDeleteModal({{$client->id}})">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $clients->links() !!}

<!-- Delete Warning Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-modal="true"
    role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeDeleteModal()">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{route('clients.destroy', $client->id)}}" method="post" id="del_modal">
                <div class="modal-body">
                        <div class="modal-body">
                            @csrf
                            @method('DELETE')
                            <h6 class="text-left">Are you sure you want to delete this client? <br> Please note that all client's transactions will also be deleted.</h5>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete Client</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>

@endsection