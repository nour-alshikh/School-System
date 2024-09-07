<?php

namespace App\Repositories;

use App\Interfaces\QuizRepositoryInterface;

use App\Models\Quiz;


class QuizRepository implements QuizRepositoryInterface
{
    public function index()
    {
        $quizzes = Quiz::get();

        return response()->json([
            'quizzes' => $quizzes
        ]);
    }

    public function store($request)
    {


        Quiz::create([

            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],

            'subject_id' => $request->subject_id,
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,

        ]);

        return response()->json([
            'status' => 201,
            'message' => "Quiz Created Successfully"
        ]);
    }
    public function update($request, $id)
    {
        $quiz = Quiz::findOrFail($id);


        $quiz->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],

            'subject_id' => $request->subject_id,
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'section_id' => $request->section_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Quiz Updated Successfully"
        ]);
    }
    public function delete($id)
    {
        Quiz::findOrFail($id)->delete();
        return response()->json([
            'status' => 201,
            'message' => "Quiz Deleted Successfully"
        ]);
    }
}
