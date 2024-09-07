<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grades\StoreGradeRequest;
use App\Http\Requests\Grades\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = LaravelLocalization::getCurrentLocale();
        $grades = Grade::all();
        return response()->json([
            'grades' => GradeResource::collection($grades),
            'locale' => $locale
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {

        // if (Grade::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {
        //     return response()->json([
        //         'message' => 'This grade already exists',
        //     ]);
        // }


        try {
            $request->validated();

            Grade::create([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ],
                'notes' => $request->notes
            ]);

            return response()->json([
                'status' => 201,
                'message' => "Grade Created Successfully"
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
    public function show(Grade $grade)
    {
        return response()->json([
            'grade' => new GradeResource($grade)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        if (Grade::where('id', '!=', $grade->id)->where(function ($query) use ($request) {
            $query->where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en);
        })->exists()) {
            return response()->json([
                'message' => 'This grade already exists',
            ]);
        }
        try {

            $request->validated();

            $grade->update([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ],
                'notes' => $request->notes
            ]);

            return response()->json([
                'status' => 201,
                'message' => "Grade Updated Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        if ($grade->classrooms->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => "Grade Can not be Deleted.This grade has classrooms"
            ]);
        }
        $grade->delete();
        return response()->json([
            'status' => 200,
            'message' => "Grade Deleted Successfully"
        ]);
    }
}
