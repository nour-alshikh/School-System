<?php

namespace App\Providers;

use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\BookRepositoryInterface;
use App\Interfaces\FeeProcessRepositoryInterface;
use App\Interfaces\FeeRepositoryInterface;
use App\Interfaces\GraduationRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\PaymentRepositoryInterface;
use App\Interfaces\PromotionRepositoryInterface;
use App\Interfaces\QuestionRepositoryInterface;
use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\ReceiptRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\SubjectRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Repositories\AttendanceRepository;
use App\Repositories\BookRepository;
use App\Repositories\FeeProcessRepository;
use App\Repositories\FeeRepository;
use App\Repositories\GraduationRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PromotionRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuizRepository;
use App\Repositories\ReceiptRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\TeacherRepository;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PromotionRepositoryInterface::class, PromotionRepository::class);
        $this->app->bind(GraduationRepositoryInterface::class, GraduationRepository::class);
        $this->app->bind(FeeRepositoryInterface::class, FeeRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(FeeProcessRepositoryInterface::class, FeeProcessRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class, SubjectRepository::class);
        $this->app->bind(QuizRepositoryInterface::class, QuizRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
