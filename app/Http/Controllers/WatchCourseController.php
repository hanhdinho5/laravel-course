<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\StudentTest;
use App\Models\Enrollment;

class WatchCourseController extends Controller
{

    public function watchCourse($id)
    {
        $course = Course::findOrFail(encryptor('decrypt', $id));
        $isEnrolled = Enrollment::where('student_id', currentUserId())
            ->where('course_id', $course->id)
            ->exists();

        if ($course->type !== 'free' && !$isEnrolled) {
            return redirect()->route('studentdashboard')->with('danger', 'Bạn chưa thanh toán khóa học này.');
        }

        $lessons = Lesson::where('course_id', $course->id)->get();
        $studentTests = StudentTest::where('student_id', encryptor('decrypt', session('userId')))->get();
        // dd(encryptor('dencrypt', session('userId')));

        return view('frontend.watchCourse', compact('course', 'lessons', 'studentTests'));
    }
}
