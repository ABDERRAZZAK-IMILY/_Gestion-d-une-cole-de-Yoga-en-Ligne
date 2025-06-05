<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index() { return Teacher::all(); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'bio' => 'nullable',
            'specialties' => 'nullable'
        ]);
        return Teacher::create($data);
    }

    public function show(Teacher $teacher) { return $teacher; }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        return $teacher;
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'Deleted']);
    }
}

