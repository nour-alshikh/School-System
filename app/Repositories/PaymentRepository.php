<?php

namespace App\Repositories;

use App\Interfaces\FeeProcessRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\FeeProcess;
use App\Models\FundAccount;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payments = Payment::get();
        return response()->json([
            'payments' => $payments
        ]);
    }
    public function store($request)
    {
        $student = Student::find($request->student_id);

        DB::beginTransaction();

        try {

            $payment = Payment::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->amount,
                'description' => $request->description,

            ]);

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => "payment",

                'student_id' => $request->student_id,
                'fee_process_id' => $payment->id,
                'credit' => 0,
                'debit' => $request->amount,
                'description' => $request->description,
            ]);

            FundAccount::create([
                'date' => date('Y-m-d'),
                'payment_id' => $payment->id,
                'debit' => 0,
                'credit' => $request->amount,
                'description' => $request->description,
            ]);

            DB::commit();
            return response()->json([
                'msg' => "Payment Added Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
    public function show($id) {}
    public function update($id, $request) {}
    public function delete($id) {}
}
