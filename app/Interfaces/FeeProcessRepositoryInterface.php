<?php

namespace App\Interfaces;


interface FeeProcessRepositoryInterface
{
    public function show($id);
    public function store($request);
}
