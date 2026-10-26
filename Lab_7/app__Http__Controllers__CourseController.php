<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return view('dashboard', [
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'course_code' => strtoupper(trim((string) $request->input('course_code', ''))),
        ]);

        $validated = $request->validate([
            'course_code' => [
                'required',
                'string',
                'max:20',
                Rule::unique('courses', 'course_code')
                    ->where('user_id', $request->user()->id),
            ],
            'course_name' => ['required', 'string', 'max:150'],
            'credit_hours' => ['required', 'integer', 'between:1,6'],
            'semester' => [
                'required',
                Rule::in(['Spring 2026', 'Fall 2026']),
            ],
        ]);

        $validated['user_id'] = $request->user()->id;

        Course::create($validated);

        return redirect()->route('dashboard')
            ->with('success', 'Course registered successfully.');
    }
}
