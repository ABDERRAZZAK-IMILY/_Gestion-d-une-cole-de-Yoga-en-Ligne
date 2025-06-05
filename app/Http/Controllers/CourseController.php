<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() { return Course::all(); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'level' => 'required',
            'duration' => 'required|integer',
            'price' => 'required|numeric'
        ]);
        return Course::create($data);
    }

    public function show(Course $course) { return $course; }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return $course;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
