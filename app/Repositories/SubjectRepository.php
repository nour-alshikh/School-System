<?php

namespace App\Repositories;

use App\Http\Resources\SubjectResource;
use App\Interfaces\SubjectRepositoryInterface;
use App\Models\Subject;

use Illuminate\Support\Facades\Validator;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::with(['grade', 'class_room', 'teacher'])->get();

        return response()->json([
            'subjects' => SubjectResource::collection($subjects)
        ]);
    }

    public function store($request)
    {
        $validated = Validator::make($request->all(), [
            'name_en' => 'string|required',
            'name_ar' => 'string|required',
            'grade_id' => 'required|exists:grades,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }


        Subject::create([

            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],

            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'teacher_id' => $request->teacher_id,

        ]);

        return response()->json([
            'status' => 201,
            'message' => "Subject Created Successfully"
        ]);
    }
    public function update($request, $id)
    {
        $subject = Subject::findOrFail($id);


        $validated = Validator::make($request->all(), [

            'name_en' => 'string|required',
            'name_ar' => 'string|required',
            'grade_id' => 'required|exists:grades,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }
        $subject->update([

            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Subject Updated Successfully"
        ]);
    }
    public function delete($id)
    {
        Subject::findOrFail($id)->delete();
        return response()->json([
            'status' => 201,
            'message' => "Subject Deleted Successfully"
        ]);
    }
}
