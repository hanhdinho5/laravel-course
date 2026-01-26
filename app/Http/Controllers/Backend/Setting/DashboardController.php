<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(1);
        // dd(Auth::user());
        // $id = encryptor('decrypt', session('userId'));
        // $user = User::find($id);
        // dd($user);
        // dd(Session::get('instructorId'));
        // dd(session()->all());
        $totalStudents = Student::count();
        $totalCourses = Course::count();
        $totalEnrollments = Enrollment::where('created_at', '>=', Carbon::now()->subMonths(2))
            ->count();
        $enrollments = Enrollment::where('created_at', '>=', Carbon::now()->subMonths(2))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        $totalTuitionFee = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->where('enrollments.status', '1')
            ->sum('courses.price');
        // dd($totalTuitionFee);

        $currentYear = Carbon::now()->year;
        $monthlyRevenue = Enrollment::join('courses', 'enrollments.course_id', '=', 'courses.id')
            ->whereYear('enrollments.created_at', $currentYear)
            ->where('enrollments.status', '1')
            ->select(DB::raw('MONTH(enrollments.created_at) as month'), DB::raw('SUM(courses.price) as total'))
            ->groupBy('month')
            ->pluck('total', 'month');
        // dd($monthlyRevenue);
        $monthlyRevenueLabels = collect(range(1, 12))->map(function ($month) {
            return 'Tháng ' . $month;
        })->values();
        $monthlyRevenueData = collect(range(1, 12))->map(function ($month) use ($monthlyRevenue) {
            return (float) ($monthlyRevenue->get($month, 0));
        })->values();

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
