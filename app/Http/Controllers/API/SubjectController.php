<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }

    public function index()
    {
        return  $this->subject->index();
    }
    public function store(Request $request)
    {
        return  $this->subject->store($request);
    }
    public function update(Request $request, string $id)
    {
        return  $this->subject->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->subject->delete($id);
    }
}
