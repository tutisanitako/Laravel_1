@extends('layouts.app')

@section('title', 'Courses List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Courses</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
</div>

@if($courses->isEmpty())
    <div class="alert alert-info">No courses found.</div>
@else
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Credits</th>
                        <th>Enrolled Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td><span class="badge bg-primary">{{ $course->code }}</span></td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->credits }}</td>
                        <td>{{ $course->students()->count() }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will remove all enrollments.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
    {{ $courses->links() }}
</div>
@endif
@endsection