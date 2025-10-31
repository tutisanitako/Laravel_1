@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="mb-4">
    <h1>{{ $student->name }}</h1>
    <p class="text-muted">
        Email: {{ $student->email }} | Birth Date: {{ $student->birth_date->format('Y-m-d') }}
    </p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to Students</a>
    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Edit Student</a>
    <a href="{{ route('students.enrollments', $student) }}" class="btn btn-primary">Manage Enrollments</a>
</div>

<div class="card">
    <div class="card-header"><h4>Additional Details</h4></div>
    <div class="card-body">
        <p>Created at: {{ $student->created_at->format('Y-m-d H:i:s') }}</p>
        <p>Updated at: {{ $student->updated_at->format('Y-m-d H:i:s') }}</p>
    </div>
</div>
@endsection