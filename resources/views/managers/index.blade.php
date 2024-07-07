@extends('layouts.app')

@section('title', 'Managers')

@section('content_header')
<h1>Managers</h1>
@stop

@section('content')
<a href="{{ route('managers.create') }}" class="btn btn-primary mb-3">Add Manager</a>
<table id="managers-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Branch</th>
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
        $('#managers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: " {{ route('managers.index') }}",
            columns: [{
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'branch',
                    name: 'branch'
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
