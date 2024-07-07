@extends('layouts.app')

@section('title', 'Branches')

@section('content_header')
<h1>Branches</h1>
@stop

@section('content')
<a href="{{ route('branches.create') }}" class="btn btn-primary mb-3">Add Branch</a>
<table id="branches-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Manager(s)</th>
            <th>Number of Customers</th>
            <th>Number of Complaints</th>
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
        $('#branches-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: " {{ route('branches.index') }}", columns: [{ data: 'name' , name: 'name' }, { data: 'location' , name: 'location' }, { data: 'manager_name' , name: 'manager_name' }, { data: 'customers_count' , name: 'customers_count' }, { data: 'complaints_count' , name: 'complaints_count' }, { data: 'actions' , name: 'actions' , orderable: false, searchable: false } ] }); }); </script>
    @stop
