<?php

namespace App\Repositories;

use App\Http\Resources\InvoiceResource;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Models\Invoice;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function index()
    {
        $invoices = Invoice::get();
        return response()->json([
            'invoices' => InvoiceResource::collection($invoices)
        ]);
    }
    public function store($request)
    {

        DB::beginTransaction();

        try {

            $data = $request->data;

            foreach ($data as $item) {
                $invoice = Invoice::create([
                    'invoice_date' => $item['invoice_date'],
                    'student_id' => $item['student_id'],
                    'grade_id' => $item['grade_id'],
                    'class_room_id' => $item['class_room_id'],
                    'fee_id' => $item['fee_id'],
                    'amount' => $item['amount'],
                    'type' => "invoice",
                    'description' => $item['description'],
                ]);


                StudentAccount::create([
                    'date' => $item['invoice_date'],
                    'type' => "invoice",
                    'student_id' => $item['student_id'],
                    'grade_id' => $item['grade_id'],
                    'invoice_id' => $invoice->id,
                    'class_room_id' => $item['class_room_id'],
                    'debit' => $item['amount'],
                    'credit' => 0,
                    'description' => $item['description'],
                ]);
            }

            DB::commit();
            return response()->json([
                'msg' => "Invoice Created Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            $account = StudentAccount::where('invoice_id',  $id)->first();
            $account->update([
                $account->debit = $request->amount,
                $account->description = $request->description,
            ]);
            DB::commit();
            return response()->json([
                'msg' => "Invoice Updated Successfully"
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
        Invoice::findOrFail($id)->delete();
        return response()->json([
            'msg' => "Invoice Deleted Successfully"
        ]);
    }
}
