<?php

namespace App\Interfaces;


interface EventRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request);
    public function delete($id);
}
