<?php

namespace App\Http\Controllers\Api\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public $invoice;
    public function __construct(InvoiceRepositoryInterface $invoice)
    {
        $this->invoice = $invoice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->invoice->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->invoice->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->invoice->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->invoice->delete($id);
    }
}
