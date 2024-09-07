<?php

namespace App\Interfaces;


interface FeeRepositoryInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request);
    public function delete($id);
}
