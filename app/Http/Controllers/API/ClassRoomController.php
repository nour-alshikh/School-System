<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoom\StoreClassRoomRequest;
use App\Http\Resources\ClassRoomResource;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = ClassRoom::with('grade')->get();
        return response()->json(ClassRoomResource::collection($classrooms));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRoomRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }


        // Validate the incoming request data
        $request->validated();

        // Retrieve the data from the request
        $data = $request->input('data');

        try {
            DB::beginTransaction();

            // Use a transaction to ensure all or none are inserted
            foreach ($data as $item) {

                if (ClassRoom::where('grade_id', $item['grade_id'])->where(function ($query) use ($item) {
                    $query->where('name->ar', $item['name']['ar'])->orWhere('name->en', $item['name']['en']);
                })->exists()) {

                    return response()->json([
                        'message' => 'This classroom already exists',
                    ]);
                }

                ClassRoom::create([
                    'name' => [
                        'ar' => $item['name']['ar'],
                        'en' => $item['name']['en']
                    ],
                    'grade_id' => $item['grade_id']
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 201,
                'message' => "Classrooms Created Successfully"
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
    public function show(string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        return response()->json([
            'classroom' => new ClassRoomResource($classRoom)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        try {
            $classRoom->update([
                'name' => [
                    'ar' => $request->name_ar,
                    'en' => $request->name_en
                ],
                'grade_id' => $request->grade_id
            ]);

            return response()->json([
                'status' => 201,
                'message' => "Classroom Updated Successfully"
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
    public function destroy(string $id)
    {
        $classRoom = ClassRoom::findOrFail($id);

        if ($classRoom->sections->count() > 0) {
            return response()->json([
                'status' => 200,
                'message' => "Classroom Can not be Deleted.This classroom has sections"
            ]);
        }

        $classRoom->delete();

        return response()->json([
            'status' => 200,
            'message' => "Classroom Deleted Successfully"
        ]);
    }

    public function bulkDelete(Request $request)
    {
        try {
            DB::beginTransaction();

            $ids = $request->ids;

            ClassRoom::whereIn("id", $ids)->delete();

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => "Classrooms Deleted Successfully"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function bulkFilterByGrade(Request $request)
    {
        $ids = $request->ids;

        $classrooms = ClassRoom::whereIn("grade_id", $ids)->get();

        return response()->json(ClassRoomResource::collection($classrooms));
    }
    public function filterByGrade(Request $request)
    {
        $classrooms = ClassRoom::where('grade_id', $request->grade_id)->get();
        return ClassRoomResource::collection($classrooms);
    }
}
