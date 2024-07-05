@extends('layouts.app')

@section('title', 'Managers')

@section('content_header')
<h1>Managers</h1>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="mb-3">
    <a href="{{ route('managers.create') }}" class="btn btn-primary">Add Manager</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
            <tr>
                <td>{{ $manager->first_name }} {{ $manager->last_name }}</td>
                <td>{{ $manager->phone }}</td>
                <td>{{ $manager->branch->name }}</td>
                <td>
                    <a href="{{ route('managers.edit', $manager->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('managers.destroy', $manager->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $managers->links() }}
</div>
@endsection
