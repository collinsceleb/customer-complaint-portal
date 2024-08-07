@extends('layouts.app')
@section('title', 'Edit Manager')

@section('content_header')
<h1>Edit Manager</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('managers.update', $manager->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name', $manager->first_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name', $manager->last_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $manager->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $manager->phone) }}">
                    </div>
                    <div class="form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" class="form-control" id="branch_id">
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $manager->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Manager</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
