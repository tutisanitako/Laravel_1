@extends('layouts.app')

@section('title', 'Student Enrollments')

@section('content')
<div class="mb-4">
    <h1>Enrollments for {{ $student->name }}</h1>
    <p class="text-muted">Email: {{ $student->email }} | Birth Date: {{ $student->birth_date->format('Y-m-d') }}</p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to Students</a>
</div>

<div class="row">
    <!-- Enrolled Courses -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h4>Enrolled Courses</h4>
            </div>
            <div class="card-body">
                @if($enrolledCourses->isEmpty())
                    <p class="text-muted">No courses enrolled yet.</p>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credits</th>
                                <th>Enrollment Date</th>
                                <th>Grade</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrolledCourses as $enrollment)
                            <tr>
                                <td>{{ $enrollment->course->code }}</td>
                                <td>{{ $enrollment->course->title }}</td>
                                <td>{{ $enrollment->course->credits }}</td>
                                <td>{{ $enrollment->enrollment_date->format('Y-m-d') }}</td>
                                <td>
                                    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="grade" value="{{ $enrollment->grade }}" 
                                               class="form-control form-control-sm d-inline" style="width: 60px;" 
                                               placeholder="A+">
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Remove this enrollment?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Enroll in New Course -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h4>Enroll in New Course</h4>
            </div>
            <div class="card-body">
                @if($availableCourses->isEmpty())
                    <p class="text-muted">No available courses to enroll in.</p>
                @else
                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">

                        <div class="mb-3">
                            <label for="course_id" class="form-label">Select Course</label>
                            <select name="course_id" id="course_id" class="form-select" required>
                                <option value="">-- Choose a course --</option>
                                @foreach($availableCourses as $course)
                                    <option value="{{ $course->id }}">
                                        {{ $course->code }} - {{ $course->title }} ({{ $course->credits }} credits)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="enrollment_date" class="form-label">Enrollment Date</label>
                            <input type="date" name="enrollment_date" id="enrollment_date" 
                                   class="form-control" value="{{ date('Y-m-d') }}">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Enroll Student</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection