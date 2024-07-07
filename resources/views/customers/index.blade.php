@extends('layouts.app')

@section('title', 'Customers')

@section('content_header')
<h1>Customers</h1>
@stop

@section('content')
<a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add Customer</a>
<table id="customers-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Full Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Number of Complaints</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#customers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: " {{ route('customers.index') }}",
            columns: [{
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'full_address',
                    name: 'full_address'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'complaints_count',
                    name: 'complaints_count'
                },
                {
                    data: 'photo',
                    name: 'photo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@stop
