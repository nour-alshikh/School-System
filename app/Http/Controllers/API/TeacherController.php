<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teacher;

    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }

    public function index()
    {
        return  $this->teacher->getAllTeachers();
    }
    public function store(Request $request)
    {
        return  $this->teacher->storeTeacher($request);
    }
    public function show(string $id)
    {
        return  $this->teacher->GetTeacherById($id);
    }
    public function update(Request $request, string $id)
    {
        return  $this->teacher->update($request, $id);
    }
    public function destroy(string $id)
    {
        return  $this->teacher->deleteTeacher($id);
    }
    public function getGenders()
    {
        return  $this->teacher->getGenders();
    }
    public function getSpecializations()
    {
        return  $this->teacher->getSpecializations();
    }
}
