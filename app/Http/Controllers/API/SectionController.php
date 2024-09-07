<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
use App\Http\Resources\GradeWithSectionResource;
use App\Http\Resources\SectionResource;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::get();
        return response()->json([
            'grades' => GradeWithSectionResource::collection($grades),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        $request->validated;
        $data = $request->input('data');

        try {
            DB::beginTransaction();

            foreach ($data as $item) {
                $section = Section::create([
                    'name' => [
                        'en' => $item['name']['en'],
                        'ar' => $item['name']['ar']
                    ],
                    'grade_id' => $item['grade_id'],
                    'class_room_id' => $item['class_room_id'],
                ]);

                $section->teachers()->attach($item['teacher_id']);
            }

            DB::commit();

            return response()->json([
                'status' => 201,
                'message' => "Sections Created Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return response()->json([
            'Section' =>  new SectionResource($section)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $request->validated;
        $section->update([
            'name' => [
                'en' => $request['name']['en'],
                'ar' => $request['name']['ar']
            ],
            'grade_id' => $request['grade_id'],
            'class_room_id' => $request['class_room_id'],
            'status' => $request['status']
        ]);

        $section->teachers()->sync($request->teacher_ids);

        return response()->json([
            'status' => 201,
            'message' => "Section Updated Successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {

        $section->delete();

        return response()->json([
            'status' => 200,
            'message' => "Section Deleted Successfully"
        ]);
    }
}
