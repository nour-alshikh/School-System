<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->attendance->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->attendance->show($id);
    }
}
