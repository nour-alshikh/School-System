<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        return  $this->student->getAllStudents();
    }
    public function store(Request $request)
    {
        return  $this->student->storeStudent($request);
    }
    public function show(string $id)
    {
        return $this->student->GetStudentById($id);
    }
    public function update(Request $request, string $id)
    {
        return  $this->student->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->student->deleteStudent($id);
    }

    public function getClassrooms(string $id)
    {
        return $this->student->getClassrooms($id);
    }
    public function getSections(string $id)
    {
        return $this->student->getSections($id);
    }
    public function uploadAttachments(Request $request)
    {
        return $this->student->uploadAttachments($request);
    }
    public function downloadAttachment(string $student_name, string $file_name)
    {
        return $this->student->downloadAttachment($student_name, $file_name);
    }
    public function deleteAttachment(Request $request)
    {
        return $this->student->deleteAttachment($request);
    }
}
