@extends('layouts.app')

@section('title', 'Edit Complaint')

@section('content_header')
<h1>Edit Complaint</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('complaints.update', $complaint->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="customer_id">Customer</label>
                        <select name="customer_id" class="form-control" id="customer_id">
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ $complaint->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" class="form-control" id="branch_id">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $complaint->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" class="form-control" id="category">
                            <option value="Service" {{ $complaint->category == 'Service' ? 'selected' : '' }}>Service</option>
                            <option value="Product" {{ $complaint->category == 'Product' ? 'selected' : '' }}>Product</option>
                            <option value="Other" {{ $complaint->category == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description">{{ old('description', $complaint->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Reviewed" {{ $complaint->status == 'Reviewed' ? 'selected' : '' }}>Reviewed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Complaint</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
