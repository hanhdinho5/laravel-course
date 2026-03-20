<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalCourses = Course::count();

        $recentFrom = Carbon::now()->subMonths(2)->startOfDay();

        $totalEnrollments = Enrollment::where('enrollment_date', '>=', $recentFrom)->count();

        $enrollments = Enrollment::with(['student', 'course.instructor'])
            ->where('enrollment_date', '>=', $recentFrom)
            ->orderByDesc('enrollment_date')
            ->limit(10)
            ->get();

        $totalTuitionFee = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('enrollments.status', 1)
            ->sum('courses.price');

        $currentYear = Carbon::now()->year;

        $monthlyRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->whereYear('enrollments.enrollment_date', $currentYear)
            ->where('enrollments.status', 1)
            ->select(
                DB::raw('MONTH(enrollments.enrollment_date) as month'),
                DB::raw('SUM(courses.price) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthlyRevenueLabels = collect(range(1, 12))
            ->map(fn($month) => 'Tháng ' . $month)
            ->values();

        $monthlyRevenueData = collect(range(1, 12))
            ->map(fn($month) => (float) $monthlyRevenue->get($month, 0))
            ->values();

        return view('backend.adminDashboard', compact(
            'totalStudents',
            'totalCourses',
            'totalTuitionFee',
            'totalEnrollments',
            'enrollments',
            'monthlyRevenueLabels',
            'monthlyRevenueData'
        ));
    }
}
