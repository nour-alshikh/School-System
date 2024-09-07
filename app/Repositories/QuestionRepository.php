<?php

namespace App\Repositories;

use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {
        $questions = Question::get();

        return response()->json([
            'questions' => $questions
        ]);
    }

    public function store($request)
    {
        Question::create([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'score' => $request->score,
            'quiz_id' => $request->quiz_id,

        ]);

        return response()->json([
            'status' => 201,
            'message' => "Question Created Successfully"
        ]);
    }
    public function update($request, $id)
    {
        $question = Question::findOrFail($id);


        $question->update([
            'title' => $request->title,
            'answers' => $request->answers,
            'right_answer' => $request->right_answer,
            'score' => $request->score,
            'quiz_id' => $request->quiz_id,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Question Updated Successfully"
        ]);
    }
    public function delete($id)
    {
        Question::findOrFail($id)->delete();
        return response()->json([
            'status' => 201,
            'message' => "Question Deleted Successfully"
        ]);
    }
}
