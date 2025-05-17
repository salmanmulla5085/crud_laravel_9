@extends('layouts.app')

@section('content')
<style>
    .dataTables_paginate {
    margin-top: 15px;
    text-align: center !important;
}

.paginate_button {
    margin: 0 3px;
}
    </style>
<div class="container">
    {{-- <h2 class="mb-4">User Management</h2> --}}

    <button class="btn btn-primary mb-3" id="addUserBtn">Add User</button>
<div id="messageBox" class="alert d-none" role="alert"></div>
    <table class="table table-bordered" id="usersTable">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
                <th>Address</th><th>Active</th><th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
{{--  --}}
@include('user.form') <!-- Modal Form -->
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/user.js') }}"></script>
@endpush
