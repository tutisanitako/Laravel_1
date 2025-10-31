<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
        ]);

        $exists = Enrollment::where('student_id', $validated['student_id'])
                            ->where('course_id', $validated['course_id'])
                            ->exists();

        if ($exists) {
            return back()->with('error','Student is already enrolled in this course.');
        }

        Enrollment::create($validated + ['grade' => null]);

        return back()->with('success','Enrollment created successfully.');
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'grade' => 'nullable|string|max:2',
        ]);

        $enrollment->update($validated);

        return back()->with('success','Grade updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return back()->with('success','Enrollment removed successfully.');
    }
}