<?php

namespace App\Repositories;

use App\Http\Resources\ClassRoomResource;
use App\Http\Resources\SectionResource;
use App\Http\Resources\StudentResource;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\ClassRoom;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAllStudents()
    {
        $students = Student::get();
        return response()->json([
            'students' => StudentResource::collection($students)
        ]);
    }
    public function storeStudent($request)
    {
        $validated = Validator::make($request->all(), [
            'email' => 'email|unique:students,id',
            'password' => 'required',
            'name_en' => 'string|required',
            'name_ar' => 'string|required',
            'gender_id' => 'required|exists:genders,id',
            'grade_id' => 'required|exists:grades,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'section_id' => 'required|exists:sections,id',
            'blood_type_id' => 'required|exists:blood_types,id',
            'nationality_id' => 'required|exists:nationalities,id',
            'guardian_id' => 'required|exists:guardians,id',
            'birth_date' => 'required',
            'academic_year' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()], 422);
        }

        try {
            DB::beginTransaction();

            $request['password'] = Hash::make($request->password);
            $student =  Student::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en,
                ],
                'gender_id' => $request->gender_id,
                'grade_id' => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id' => $request->section_id,
                'nationality_id' => $request->nationality_id,
                'guardian_id' => $request->guardian_id,
                'blood_type_id' => $request->blood_type_id,
                'birth_date' => $request->birth_date,
                'academic_year' => $request->academic_year,
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $name = $image->getClientOriginalName();

                    $image->storeAs("students/" . $student->name, $name, "attachments");

                    Image::create([
                        'file_name' => $name,
                        "imageable_id" => $student->id,
                        "imageable_type" => "App\Models\Student",
                    ]);
                }
            }

            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => "Student Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function GetStudentById($id)
    {
        $student = Student::findOrFail($id);
        return response()->json([
            'student' => new StudentResource($student)
        ]);
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $student = Student::findOrFail($id);

            $validated = Validator::make($request->all(), [
                'email' => 'email|unique:students,id',
                'password' => 'required',
                'name_en' => 'string|required',
                'name_ar' => 'string|required',
                'gender_id' => 'required|exists:genders,id',
                'grade_id' => 'required|exists:grades,id',
                'class_room_id' => 'required|exists:class_rooms,id',
                'section_id' => 'required|exists:sections,id',
                'blood_type_id' => 'required|exists:blood_types,id',
                'nationality_id' => 'required|exists:nationalities,id',
                'guardian_id' => 'required|exists:guardians,id',
                'birth_date' => 'required',
                'academic_year' => 'required',
            ]);

            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()], 422);
            }


            $student->update([
                'email' => $request->email ?? $student->email,
                'password' => Hash::make($request->password),
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en,
                ],
                'gender_id' => $request->gender_id,
                'grade_id' => $request->grade_id,
                'class_room_id' => $request->class_room_id,
                'section_id' => $request->section_id,
                'nationality_id' => $request->nationality_id,
                'guardian_id' => $request->guardian_id,
                'blood_type_id' => $request->blood_type_id,
                'birth_date' => $request->birth_date ?? $student->birth_date,
                'academic_year' => $request->academic_year,
            ]);
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => "Student Updated Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json([
            'student' => "Student Deleted Successfully"
        ]);
    }

    public function getClassrooms($id)
    {
        $classrooms = ClassRoom::where('grade_id', $id)->get();
        return response()->json([
            'classrooms' => ClassRoomResource::collection($classrooms)
        ]);
    }
    public function getSections($id)
    {
        $sections = Section::where('class_room_id', $id)->get();
        return response()->json([
            'sections' => SectionResource::collection($sections)
        ]);
    }
    public function uploadAttachments($request)
    {
        $student = Student::findOrFail($request->student_id);
        $student_name = $student->name;


        foreach ($request->file('images') as $image) {

            $name = $image->getClientOriginalName();

            $image->storeAs("attachments/students/" . $student_name, $name, "attachments");

            Image::create([
                'file_name' => $name,
                "imageable_id" => $request->student_id,
                "imageable_type" => "App\Models\Student",
            ]);
        }
    }

    public function downloadAttachment($student_name, $file_name)
    {
        return response()->download(public_path('attachments/attachments/students/' . $student_name . '/' . $file_name));
    }
    public function deleteAttachment($request)
    {

        try {
            DB::beginTransaction();

            Storage::disk('attachments')->delete('attachments/students/' . $request->student_name . '/' . $request->file_name);
            Image::where('file_name', $request->file_name)->where('id', $request->image_id)->delete();

            DB::commit();
            return response()->json([
                'msg' => "Image Deleted Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
