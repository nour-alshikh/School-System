<?php

namespace App\Repositories;

use App\Http\Resources\AttendanceResource;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $data = $request->data;

            foreach ($data as $student) {
                Attendance::create([
                    "attendance_date" => date("Y-m-d"),
                    "grade_id" => $request->grade_id,
                    "class_room_id" => $request->class_room_id,
                    "section_id" => $request->section_id,
                    "teacher_id" => $request->teacher_id,
                    "student_id" => $student['student_id'],
                    "attendance_status" => $student['attendance_status'],
                ]);
            }

            DB::commit();
            return response()->json([
                'msg' => "Attendance saved Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    public function show($id)
    {
        $students = Attendance::with(['student', 'teacher', 'section'])->where('section_id', $id)->get();
        return response()->json([
            'students' => AttendanceResource::collection($students)
        ]);
    }
}
