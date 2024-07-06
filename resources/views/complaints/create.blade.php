@extends('layouts.app')

@section('title', 'Create Complaint')

@section('content_header')
<h1>Create Complaint</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('complaints.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="branch_id">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control" required>
                    @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="reviewed">Reviewed</label>
                <input type="checkbox" name="reviewed" id="reviewed" value="1">
            </div>

            <button type="submit" class="btn btn-success">Create Complaint</button>
        </form>
    </div>
</div>
@stop
