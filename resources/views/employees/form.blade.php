@extends('layouts.app')

@section('title', isset($employee) ? 'Edit Employee' : 'Create Employee')

@section('content')
@if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        });
    </script>
@endif
    <h2>{{ isset($employee) ? 'Edit' : 'Create' }} Employee</h2>

    <form method="POST" action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}">
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Employee Govt ID</label>
            <input type="text" name="employee_govt_id" class="form-control" required pattern="^3\d{8}5$"
                   value="{{ old('employee_govt_id', $employee->employee_govt_id ?? '') }}">
            <div class="form-text">Must be a 10-digit number starting with 3 and ending with 5</div>
            @error('employee_govt_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name" class="form-control" required
                   value="{{ old('first_name', $employee->first_name ?? '') }}">
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name" class="form-control" required
                   value="{{ old('last_name', $employee->last_name ?? '') }}">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required
                   value="{{ old('email', $employee->email ?? '') }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Department</label>
            <select name="department_id" class="form-select" required>
                <option value="">Select Department</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}"
                        {{ old('department_id', $employee->department_id ?? '') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Hire Date</label>
            <input type="date" name="hire_date" class="form-control" required
                   value="{{ old('hire_date', isset($employee->hire_date) ? $employee->hire_date->format('Y-m-d') : '') }}">
            @error('hire_date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="active" {{ old('status', $employee->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $employee->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($employee) ? 'Update' : 'Create' }}
        </button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
