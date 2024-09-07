<?php

namespace App\Interfaces;


interface BookRepositoryInterface
{
    public function index();
    public function store($request);

    public function update($request, $id);
    public function delete($id);
    public function download($id);
}
