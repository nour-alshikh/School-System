<?php

namespace App\Interfaces;

use Illuminate\Support\Facades\Request;

interface StudentRepositoryInterface
{

    public function getAllStudents();
    public function storeStudent($request);
    public function GetStudentById($id);
    public function update($request, $id);
    public function deleteStudent($id);
    public function getClassrooms($id);
    public function getSections($id);
    public function uploadAttachments($request);
    public function downloadAttachment(string $student_name, string $file_name);
    public function deleteAttachment($request);
}
