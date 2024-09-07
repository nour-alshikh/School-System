<?php

namespace App\Interfaces;

use Illuminate\Support\Facades\Request;

interface TeacherRepositoryInterface
{
    public function getGenders();
    public function getSpecializations();
    public function getAllTeachers();
    public function storeTeacher($request);
    public function GetTeacherById($id);
    public function update($request, $id);
    public function deleteTeacher($id);
}
