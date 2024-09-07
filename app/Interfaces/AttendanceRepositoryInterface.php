<?php

namespace App\Interfaces;


interface AttendanceRepositoryInterface
{
    public function store($request);
    public function show($id);
}
