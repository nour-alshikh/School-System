<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\PromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public $promotion;
    public function __construct(PromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->promotion->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->promotion->store($request);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->promotion->destroy($id);
    }
    public function getSectionStudents(string $section_id)
    {
        return $this->promotion->getSectionStudents($section_id);
    }
}
