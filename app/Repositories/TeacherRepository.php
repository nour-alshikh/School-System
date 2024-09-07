<?php

namespace App\Repositories;

use App\Http\Resources\TeacherResource;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeachers()
    {
        $teachers = Teacher::with(['gender', 'specialization'])->get();
        return response()->json([
            'teachers' => TeacherResource::collection($teachers)
        ]);
    }
    public function storeTeacher($request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'email|unique:teachers,id',
            'password' => 'required',
            'name_en' => 'string|required',
            'name_ar' => 'string|required',
            'gender_id' => 'required|exists:genders,id',
            'specialization_id' => 'required|exists:specializations,id',
            'address' => 'required',
            'join_date' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        $request['password'] = Hash::make($request->password);
        Teacher::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'gender_id' => $request->gender_id,
            'specialization_id' => $request->specialization_id,
            'address' => $request->address,
            'join_date' => $request->join_date,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Teacher Created Successfully"
        ]);
    }

    public function GetTeacherById($id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json([
            'teacher' => new TeacherResource($teacher)
        ]);
    }

    public function update($request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'email' => 'email|unique:teachers,email,' . $teacher->id,
            'name_en' => 'string|required',
            'name_ar' => 'string|required',
            'gender_id' => 'required|exists:genders,id',
            'specialization_id' => 'required|exists:specializations,id',
            'address' => 'required',
            'join_date' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }
        $teacher->update([
            'email' => $request->email,
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'gender_id' => $request->gender_id,
            'specialization_id' => $request->specialization_id,
            'address' => $request->address,
            'join_date' => $request->join_date,
        ]);
        return response()->json([
            'status' => 201,
            'message' => "Teacher Updated Successfully"
        ]);
    }
    public function deleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json([
            'teacher' => "Teacher Deleted Successfully"
        ]);
    }

    public function getGenders()
    {
        $genders = Gender::get();
        return response()->json([
            'genders' => $genders,
        ]);
    }
    public function getSpecializations()
    {
        $specializations = Specialization::get();
        return response()->json([
            'specializations' => $specializations,
        ]);
    }
}
