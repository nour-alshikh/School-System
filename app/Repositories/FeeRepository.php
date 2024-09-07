<?php

namespace App\Repositories;

use App\Http\Resources\FeesResource;
use App\Interfaces\FeeRepositoryInterface;
use App\Models\Fee;

class FeeRepository implements FeeRepositoryInterface
{

    public function index()
    {
        $fees = Fee::get();
        return response()->json([
            'fees' => FeesResource::collection($fees)
        ]);
    }
    public function store($request)
    {
        Fee::create([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'notes' => $request->notes,
            'year' => $request->year,
            'fee_type' => $request->fee_type,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Fee Created Successfully"
        ]);
    }
    public function show($id)
    {
        $fee = Fee::findOrFail($id);
        return response()->json([
            'amount' => $fee->amount
        ]);
    }
    public function update($request)
    {
        $fee = Fee::findOrFail($request->id);

        $fee->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
            'amount' => $request->amount,
            'grade_id' => $request->grade_id,
            'class_room_id' => $request->class_room_id,
            'notes' => $request->notes,
            'year' => $request->year,
            'fee_type' => $request->fee_type,
        ]);

        return response()->json([
            'status' => 201,
            'message' => "Fee Updated Successfully"
        ]);
    }
    public function delete($id)
    {
        $fee = Fee::findOrFail($id)->delete();
        return response()->json([
            'status' => 201,
            'message' => "Fee Deleted Successfully"
        ]);
    }
}
