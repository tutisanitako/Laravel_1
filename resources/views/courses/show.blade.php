@extends('layouts.app')

@section('title', 'Course Details')

@section('content')
<div class="mb-4">
    <h1>{{ $course->title }}</h1>
    <p class="text-muted">
        <span class="badge bg-primary fs-6">{{ $course->code }}</span>
        <span class="ms-2">Credits: {{ $course->credits }}</span>
    </p>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to Courses</a>
    <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Edit Course</a>
</div>

<div class="card">
    <div class="card-header">
        <h4>Enrolled Students ({{ $course->students->count() }})</h4>
    </div>
    <div class="card-body">
        @if($course->students->isEmpty())
            <p class="text-muted">No students enrolled in this course yet.</p>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Enrollment Date</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->pivot->enrollment_date }}</td>
                        <td>
                            @if($student->pivot->grade)
                                <span class="badge bg-success">{{ $student->pivot->grade }}</span>
                            @else
                                <span class="badge bg-secondary">No grade</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('students.enrollments', $student) }}" class="btn btn-sm btn-info">View Student</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection