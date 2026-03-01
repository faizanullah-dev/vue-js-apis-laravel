<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // GET /api/students
    public function index()
    {
        // dd("abc");
        return response()->json(Student::latest()->get());
    }

    // POST /api/students
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|min:3',
            'email'  => 'required|email|unique:students',
            'phone'  => 'required',
            'course' => 'required',
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    // GET /api/students/{id}
    public function show(Student $student)
    {
        return response()->json($student);
    }

    // PUT /api/students/{id}
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'   => 'required|min:3',
            'email'  => 'required|email|unique:students,email,' . $student->id,
            'phone'  => 'required',
            'course' => 'required',
        ]);

        $student->update($validated);
        return response()->json($student);
    }

    // DELETE /api/students/{id}
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student delete ho gaya!']);
    }
}
