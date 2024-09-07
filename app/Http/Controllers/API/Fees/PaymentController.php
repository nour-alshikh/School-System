<?php

namespace App\Http\Controllers\Api\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $payment;
    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->payment->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->payment->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->payment->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->payment->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->payment->delete($id);
    }
}
