<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ClassRoomController;
use App\Http\Controllers\Api\Fees\PaymentController;
use App\Http\Controllers\Api\Fees\FeeProcessController;
use App\Http\Controllers\Api\Fees\FeesController;
use App\Http\Controllers\Api\Fees\InvoiceController;
use App\Http\Controllers\Api\Fees\ReceiptController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\Api\GraduatedController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LocalizationMiddleware;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware([LocalizationMiddleware::class])->group(function () {
    // Your API routes here
    // Grades Module
    Route::apiResource('grades', GradeController::class);

    // Classrooms Module
    Route::apiResource('classrooms', ClassRoomController::class);

    Route::post('classrooms/bulk-delete', [ClassRoomController::class, 'bulkDelete']);
    Route::post('classrooms/bulk-filter-by-grade', [ClassRoomController::class, 'bulkFilterByGrade']);
    Route::post('classrooms/filter-by-grade', [ClassRoomController::class, 'filterByGrade']);

    // Sections Module
    Route::apiResource('sections', SectionController::class);

    // Guardians Module
    Route::apiResource('guardians', GuardianController::class);

    Route::get('get-nationalities', [GuardianController::class, 'getNationalities']);
    Route::get('get-religions', [GuardianController::class, 'getReligions']);
    Route::get('get-blood-types', [GuardianController::class, 'getBloodTypes']);

    // Teachers Module
    Route::apiResource('teachers', TeacherController::class);
    Route::get('get-genders', [TeacherController::class, 'getGenders']);
    Route::get('get-specializations', [TeacherController::class, 'getSpecializations']);

    // Students Module
    Route::apiResource('students', StudentController::class)->except('update');
    Route::post('students/{id}', [StudentController::class, 'update']);
    Route::get('get-classrooms/{id}', [StudentController::class, 'getClassrooms']);
    Route::get('get-sections/{id}', [StudentController::class, 'getSections']);
    Route::post('student/upload-attachments', [StudentController::class, 'uploadAttachments']);
    Route::get('student/download-attachment/{student_name}/{file_name}', [StudentController::class, 'downloadAttachment']);
    Route::post('student/delete-attachment', [StudentController::class, 'deleteAttachment']);

    // Promotions Module
    Route::apiResource('promotions', PromotionController::class);
    Route::get('get-section-students/{section_id}', [PromotionController::class, 'getSectionStudents']);

    // Graduation Module
    Route::apiResource('graduations', GraduatedController::class);

    // Fees Module
    Route::apiResource('fees', FeesController::class);

    // Invoice Module
    Route::apiResource('invoices', InvoiceController::class);

    // Receipt Module
    Route::apiResource('receipts', ReceiptController::class);

    // FeeProcess Module
    Route::apiResource('fee-process', FeeProcessController::class);

    // Payment Module
    Route::apiResource('payments', PaymentController::class);

    // Attendance Module
    Route::apiResource('attendances', AttendanceController::class);

    // Subject Module
    Route::apiResource('subjects', SubjectController::class);

    // Quiz Module
    Route::apiResource('quizzes', QuizController::class);

    // Question Module
    Route::apiResource('questions', QuestionController::class);

    // Book Module
    Route::apiResource('books', BookController::class)->except('show');
    Route::get('books/download/{id}', [BookController::class, "download"]);

    // Settings Module
    Route::get('settings', [SettingController::class, "index"]);
    Route::post('settings', [SettingController::class, "updateSettings"]);
});
