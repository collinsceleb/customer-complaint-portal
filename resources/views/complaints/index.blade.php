@extends('layouts.app')

@section('title', 'Complaints')

@section('content_header')
<h1>Complaints</h1>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="mb-3">
    <a href="{{ route('complaints.create') }}" class="btn btn-primary">Add Complaint</a>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Made By</th>
                <th>Branch</th>
                <th>Title</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $complaint)
            <tr>
                <td>{{ $complaint->customer->first_name }} {{ $complaint->customer->last_name }}</td>
                <td>{{ $complaint->branch->name }}</td>
                <td>{{ $complaint->title }}</td>
                <td>{{ $complaint->message }}</td>
                <td>{{ $complaint->reviewed }}</td>
                <td>
                    <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $complaints->links() }}
</div>
@endsection
