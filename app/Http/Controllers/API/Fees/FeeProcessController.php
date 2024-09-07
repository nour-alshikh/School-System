<?php

namespace App\Http\Controllers\Api\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\FeeProcessRepositoryInterface;
use Illuminate\Http\Request;

class FeeProcessController extends Controller
{
    public $payment;
    public function __construct(FeeProcessRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Frefr";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
