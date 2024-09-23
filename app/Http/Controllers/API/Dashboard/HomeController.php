<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Grade;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data['students'] = Student::count();
        $data['grades'] = Grade::count();
        $data['classrooms'] = ClassRoom::count();
        $data['sections'] = Section::count();
        $data['teachers'] = Teacher::count();


        $latest_data['students'] = Student::latest()->take(5)->get();
        $latest_data['teachers'] = Teacher::latest()->take(5)->get();
        $latest_data['invoices'] = Invoice::latest()->take(5)->get();

        return response()->json([
            'data' => $data,
            'latest_data' => $latest_data,
        ]);
    }
}
