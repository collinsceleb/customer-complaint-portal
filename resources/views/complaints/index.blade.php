@extends('layouts.app')

@section('title', 'Complaints')

@section('content_header')
<h1>Complaints</h1>
@stop

@section('content')
<a href="{{ route('complaints.create') }}" class="btn btn-primary mb-3">Add Complaint</a>
<table id="complaints-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Title</th>
            <th>Message</th>
            <th>Customer Name</th>
            <th>Branch Name</th>
            <th>Status</th>
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
        $('#complaints-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: " {{ route('complaints.index') }}",
            columns: [{
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'branch_name',
                    name: 'branch_name'
                },
                {
                    data: 'status',
                    name: 'status'
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
