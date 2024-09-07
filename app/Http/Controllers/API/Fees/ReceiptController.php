<?php

namespace App\Http\Controllers\Api\Fees;

use App\Http\Controllers\Controller;
use App\Interfaces\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public $receipt;
    public function __construct(ReceiptRepositoryInterface $receipt)
    {
        $this->receipt = $receipt;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->receipt->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->receipt->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->receipt->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->receipt->delete($id);
    }
}
