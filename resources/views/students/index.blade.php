@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add New Student</a>
</div>

@if($students->isEmpty())
    <div class="alert alert-info">
        <strong>No students found.</strong> Create your first student using the button above!
    </div>
@else
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Birth Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->birth_date->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('students.enrollments', $student) }}" class="btn btn-sm btn-primary">Enrollments</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure? This will remove all enrollments.')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">{{ $students->links() }}</div>
@endif
@endsection