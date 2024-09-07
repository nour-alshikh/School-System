<?php

namespace App\Repositories;

use App\Interfaces\FeeProcessRepositoryInterface;
use App\Models\FeeProcess;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeProcessRepository implements FeeProcessRepositoryInterface
{
    public function show($id)
    {
        $student = Student::findOrFail($id);

        $transactions = $student->student_account;

        $debit = 0;
        $credit = 0;

        foreach ($transactions as $transaction) {
            $debit = $debit + $transaction['debit'];
            $credit = $credit + $transaction['credit'];
        }


        $amount_left = $debit - $credit;


        return $amount_left;
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $process = FeeProcess::create([
                'date' => date('Y-m-d'),
                'student_id' => $request->student_id,
                'amount' => $request->amount,
                'description' => $request->description,

            ]);

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => "fee_process",

                'student_id' => $request->student_id,
                'fee_process_id' => $process->id,

                'credit' => $request->amount,

                'debit' => 0,

                'description' => $request->description,
            ]);

            DB::commit();
            return response()->json([
                'msg' => "Account Evened Successfully"
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }
}
