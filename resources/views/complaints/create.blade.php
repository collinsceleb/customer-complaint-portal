@extends('layouts.app')

@section('title', 'Add Complaint')

@section('content_header')
<h1>Add Complaint</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('complaints.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" class="form-control" id="customer_id">
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" class="form-control" id="branch_id">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" id="category">
                            <option value="Service">Service</option>
                            <option value="Product">Product</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Reviewed">Reviewed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Complaint</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
