<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\StudentResource;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherDashboardController extends Controller
{
    public function index(string $teacherId)
    {
        $sections = Teacher::findOrFail($teacherId)->sections()->pluck('section_id');

        $students = Student::whereIn('section_id', $sections)->get();

        $data['sections_count'] = $sections->count();
        $data['students_count'] = $students->count();


        return response()->json([
            'data' => $data,
        ]);
    }

    public function getStudents(string $teacherId)
    {
        $sections = Teacher::findOrFail($teacherId)->sections;

        $sectionsIds = Teacher::findOrFail($teacherId)->sections()->pluck('section_id');

        $students = Student::whereIn('section_id', $sectionsIds)->get();

        return response()->json([
            'students' => StudentResource::collection($students),
            'sections' => SectionResource::collection($sections),
        ]);
    }


    public function attendanceReport(Request $request)
    {
        if ($request->student_id) {

            $students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])->where('student_id', $request->student_id)->get();

            return AttendanceResource::collection($students);
        } else {

            $students = Attendance::whereBetween('attendance_date', [$request->from, $request->to])->get();

            return AttendanceResource::collection($students);
        }
    }
}
