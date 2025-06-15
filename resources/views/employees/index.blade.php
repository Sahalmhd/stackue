@extends('layouts.app')

@section('title', 'Employees')

@section('content')

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        });
    </script>
@endif

    <h2>Employees</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Create New Employee</a>

    <table class="table table-bordered" id="employees-table">
        <thead>
            <tr>
                <th>Govt ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Hire Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
<script src="js/employees.js"></script>
@endsection
