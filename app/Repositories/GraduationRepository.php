<?php

namespace App\Repositories;


use App\Interfaces\GraduationRepositoryInterface;
use App\Models\Student;

class GraduationRepository implements GraduationRepositoryInterface
{

    public function index()
    {
        return Student::onlyTrashed()->get();
    }
    public function store($request)
    {
        $section_id = $request->section_id;
        $students = Student::where("section_id", $section_id)->get();

        if ($students->count() < 0) {
            return response()->json([
                'msg' => "No Students in This Section"
            ]);
        }

        foreach ($students as $student) {
            $student->delete();
        }

        return response()->json(['message' => 'Graduated successfully']);
    }
    public function update($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->restore();

        return response()->json(['message' => 'Restored successfully']);
    }
    public function delete($id)
    {
        Student::onlyTrashed()->where('id', $id)->first()->forceDelete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
