<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\StudentTest;
use Illuminate\Http\Request;

class WatchCourseController extends Controller
{
    public function watchCourse($id)
    {
        $course = Course::findOrFail(encryptor('decrypt', $id));
        $enrollment = Enrollment::where('student_id', currentUserId())
            ->where('course_id', $course->id)
            ->first();

        $isEnrolled = $enrollment && (int) $enrollment->status === 1;

        if ($course->type !== 'free' && !$isEnrolled) {
            return redirect()->route('studentdashboard')->with('danger', 'Bạn chưa thanh toán khóa học này.');
        }

        $lessons = Lesson::where('course_id', $course->id)->get();
        $studentTests = StudentTest::where('student_id', encryptor('decrypt', session('userId')))->get();

        return view('frontend.watchCourse', compact('course', 'lessons', 'studentTests'));
    }
}
