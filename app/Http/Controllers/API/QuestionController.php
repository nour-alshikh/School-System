<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\QuestionRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(QuestionRepositoryInterface $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        return  $this->question->index();
    }
    public function store(Request $request)
    {
        return  $this->question->store($request);
    }
    public function update(Request $request, string $id)
    {
        return  $this->question->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->question->delete($id);
    }
}
