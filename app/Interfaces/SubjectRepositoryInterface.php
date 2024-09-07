<?php

namespace App\Interfaces;


interface SubjectRepositoryInterface
{
    public function index();
    public function store($request);

    public function update($request, $id);
    public function delete($id);
}
