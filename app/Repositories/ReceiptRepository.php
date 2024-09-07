<?php

namespace App\Repositories;

use App\Http\Resources\ReceiptResource;
use App\Interfaces\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Receipt;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements ReceiptRepositoryInterface
{
    public function index()
    {
        $receipts = Receipt::all();
        return response()->json([
            'receipts' => ReceiptResource::collection($receipts)
        ]);
    }
    public function store($request)
    {

        DB::beginTransaction();

        try {

            $receipt = Receipt::create([
                'date' => date('Y-m-d'),
                'debit' => $request->debit,
                'student_id' => $request->student_id,
                'description' => $request->description,
            ]);

            FundAccount::create([
                'date' => date('Y-m-d'),
                'receipt_id' => $receipt->id,
                'debit' => $request->debit,
                'credit' => 0,
                'description' => $request->description,
            ]);

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => "receipt",
                'receipt_id' => $receipt->id,
                'student_id' => $request->student_id,
                'credit' => $request->debit,
                'debit' => 0,
                'description' => $request->description,
            ]);

            DB::commit();
            return response()->json([
                'msg' => "Receipt Created Successfully"
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
        $receipt = Receipt::findOrFail($id);
        return response()->json([
            'receipt' =>  new ReceiptResource($receipt)
        ]);
    }
    public function update($request, $id)
    {

        $receipt = Receipt::findOrFail($id);

        DB::beginTransaction();

        try {

            $receipt->update([
                'date' => date('Y-m-d'),
                'debit' => $request->debit,

                'description' => $request->description,
            ]);

            $fund_account =  FundAccount::where('receipt_id', $id)->first();
            $fund_account->update([
                'date' => date('Y-m-d'),
                'receipt_id' => $receipt->id,
                'debit' => $request->debit,
                'credit' => 0,
                'description' => $request->description,
            ]);

            $student_account =  StudentAccount::where('receipt_id', $id)->first();
            $student_account->update([
                'date' => date('Y-m-d'),
                'type' => "receipt",
                'receipt_id' => $receipt->id,
                'credit' => $request->debit,
                'debit' => 0,
                'description' => $request->description,
            ]);

            DB::commit();
            return response()->json([
                'msg' => "Receipt Updated Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    public function delete($id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();
        return response()->json([
            'msg' => "Receipt Deleted Successfully"
        ]);
    }
}
