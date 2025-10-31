<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
{
    $students = Student::orderBy('name')->paginate(10);
    return view('students.index', compact('students'));
}

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'birth_date' => 'required|date|before:today'
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
                        ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'birth_date' => 'required|date|before:today'
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
                        ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                        ->with('success', 'Student deleted successfully.');
    }

    /**
     * Show enrollments for a specific student
     */
    public function enrollments(Student $student)
    {
        $enrolledCourses = $student->enrollments()->with('course')->get();
        $availableCourses = \App\Models\Course::whereNotIn('id', 
            $student->courses()->pluck('courses.id')
        )->get();

        return view('students.enrollments', compact('student', 'enrolledCourses', 'availableCourses'));
    }
}