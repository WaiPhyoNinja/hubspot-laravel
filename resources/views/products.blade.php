@extends('layouts.layout')
@section('content')
<div class="container mt-3">
    <table class="table table-responsive table-hover user_datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>description</th>
                <th>Created Date</th>
                <th>properties_history</th>
                <th>Archived</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script type="text/javascript">
    $(function() {
        var table = $('.user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('display.products') }}",
            columns: [
                { data: 'id'},
                { data: 'name'},
                { data: 'price' },
                { data: 'description' },
                { data: 'createdate' },
                { data: 'properties_with_history' },
                { data: 'archived' }
            ]
        });
    });
</script>
@endsection
