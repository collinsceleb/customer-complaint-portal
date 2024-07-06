@extends('layouts.app')

@section('title', 'Create or Assign Manager')

@section('content_header')
<h1>Create or Assign Manager</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <button class="btn btn-primary" id="assign-existing-btn">Assign Existing User as Manager</button>
        <button class="btn btn-secondary" id="create-new-btn">Create New User as Manager</button>

        <form id="assign-existing-form" action="{{ route('managers.store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="existing_user" value="1">
            <div class="form-group">
                <label for="branch_id">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control">
                    @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="existing_user">Select Existing User</label>
                <select name="existing_user" id="existing_user" class="form-control">
                    <option value="">-- Select a User --</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}" data-phone="{{ $user->phone }}">{{ $user->name }} ({{ $user->email }} ) ({{ $user->phone }} )</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" id="user_email" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label for="user_phone">Phone</label>
                <input type="text" id="user_phone" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success">Assign Manager</button>
        </form>

        <form id="create-new-form" action="{{ route('managers.store') }}" method="POST" style="display: none;">
            @csrf
            <div class="form-group">
                <label for="branch_id_new">Branch</label>
                <select name="branch_id" id="branch_id_new" class="form-control">
                    @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Create Manager</button>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    document.getElementById('assign-existing-btn').addEventListener('click', function() {
        document.getElementById('assign-existing-form').style.display = 'block';
        document.getElementById('create-new-form').style.display = 'none';
    });

    document.getElementById('create-new-btn').addEventListener('click', function() {
        document.getElementById('assign-existing-form').style.display = 'none';
        document.getElementById('create-new-form').style.display = 'block';
    });

    document.getElementById('existing_user').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var fullName = selectedOption.getAttribute('data-name');
        var firstName = fullName.split(" ")[0];
        var lastName = fullName.split(" ")[1];
        document.getElementById('first_name').value = firstName;
        document.getElementById('last_name').value = lastName;
        document.getElementById('user_email').value = selectedOption.getAttribute('data-email');
        document.getElementById('user_phone').value = selectedOption.getAttribute('data-phone');
    });
</script>
@stop
