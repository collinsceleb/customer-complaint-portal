@extends('layouts.app')
@section('title', 'Branches')

@section('content_header')
<h1>Branches</h1>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="mb-3">
    <a href="{{ route('branches.create') }}" class="btn btn-primary">Add Branch</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Number of Customers</th>
                <th>Number of Complaints</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($branches as $branch)
            <tr>
                <td>{{ $branch->name }}</td>
                <td>{{ $branch->address }}, {{ $branch->city }}, {{ $branch->state }}</td>
                <td>{{ $branch->customers->count() }}</td>
                <td>{{ $branch->complaints->count() }}</td>
                <td>
                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $branches->links() }}
</div>
@endsection
