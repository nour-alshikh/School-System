<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quiz;

    public function __construct(QuizRepositoryInterface $quiz)
    {
        $this->quiz = $quiz;
    }

    public function index()
    {
        return  $this->quiz->index();
    }
    public function store(Request $request)
    {
        return  $this->quiz->store($request);
    }
    public function update(Request $request, string $id)
    {
        return  $this->quiz->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->quiz->delete($id);
    }
}
