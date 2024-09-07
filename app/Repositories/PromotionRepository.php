<?php

namespace App\Repositories;

use App\Http\Resources\PromotionResource;
use App\Http\Resources\StudentResource;
use App\Interfaces\PromotionRepositoryInterface;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function getSectionStudents($section_id)
    {
        $students = Student::where("section_id", $section_id)->get();

        return response()->json([
            'students' => StudentResource::collection($students)
        ]);
    }

    public function store($request)
    {
        $section_id = $request->section_id;
        $students = Student::where("section_id", $section_id)->get();

        if ($students->count() < 0) {
            return response()->json([
                'msg' => "No Students in This Section"
            ]);
        }
        DB::beginTransaction();
        try {
            foreach ($students as $student) {

                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $student->grade_id,
                    'from_class_room' => $student->class_room_id,
                    'from_section' => $student->section_id,
                    'from_academic_year' => $student->academic_year,
                    'to_grade' => $request->to_grade,
                    'to_class_room' => $request->to_class_room,
                    'to_section' => $request->to_section,
                    'to_academic_year' => $request->to_academic_year,
                ]);

                $student->update([
                    'grade_id' => $request->to_grade,
                    'class_room_id' => $request->to_class_room,
                    'section_id' => $request->to_section,
                    'academic_year' => $request->to_academic_year,
                ]);
            }
            DB::commit();
            return response()->json([
                'msg' => "Students Promoted Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function index()
    {
        $promotion = Promotion::all();

        return response()->json([
            'promotions' => PromotionResource::collection($promotion)
        ]);
    }
    public function destroy($id)
    {
        switch ($id) {
            case 'all':
                try {
                    DB::beginTransaction();

                    $promotions = Promotion::all();

                    foreach ($promotions as $promotion) {

                        $student = Student::where('id', $promotion->student_id)->first();

                        $student->update([
                            'grade_id' => $promotion->from_grade,
                            'class_room_id' => $promotion->from_class_room,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->from_academic_year,
                        ]);

                        $promotion->delete();
                    }

                    // Promotion::truncate();
                    DB::commit();

                    return response()->json([
                        'msg' => "Promotions rolled back successfully"
                    ]);
                } catch (\Throwable $e) {
                    DB::rollBack();
                }

                break;
            default:

                try {
                    DB::beginTransaction();

                    $promotion = Promotion::findOrFail($id);


                    $student = Student::where('id', $promotion->student_id)->first();

                    $student->update([
                        'grade_id' => $promotion->from_grade,
                        'class_room_id' => $promotion->from_class_room,
                        'section_id' => $promotion->from_section,
                        'academic_year' => $promotion->from_academic_year,
                    ]);

                    $promotion->delete();

                    DB::commit();

                    return response()->json([
                        'msg' => "Promotion rolled back successfully"
                    ]);
                } catch (\Throwable $e) {
                    DB::rollBack();
                }

                break;
        }
    }
}
