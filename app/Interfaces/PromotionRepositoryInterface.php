<?php

namespace App\Interfaces;

use Illuminate\Support\Facades\Request;

interface PromotionRepositoryInterface
{
    public function getSectionStudents($section_id);
    public function store($request);
    public function index();
    public function destroy($id);
}
