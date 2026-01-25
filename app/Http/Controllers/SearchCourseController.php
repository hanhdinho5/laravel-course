<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\DB;

class SearchCourseController extends Controller
{
    public function index(Request $request)
    {
        $textS = '';
        $selectedLevels = $request->levels ?? []; // lọc theo mức độ

        if ($request->input('textSearch'))
            $textS = $request->input('textSearch');
        $category = CourseCategory::get();
        $selectedCategories = $request->input('categories', []);
        if (empty($selectedCategories)) {
            $singleCategory = $request->input('category_id', $request->input('category'));
            if (!empty($singleCategory)) {
                $selectedCategories = [$singleCategory];
            }
        }

        $course = Course::where('status', 2)->where('title', 'like', '%' . $textS . '%')
            ->when($selectedCategories, function ($query) use ($selectedCategories) {
                $query->whereIn('course_category_id', $selectedCategories);
            })->when($selectedLevels, function ($q) use ($selectedLevels) {
                $q->whereIn('level', $selectedLevels);
            })->paginate(6);
        // dd ($course);
        // Đếm số khóa học theo mỗi mức độ
        $levelCounts = Course::where('status', 2)
            ->select('level', DB::raw('COUNT(*) as total'))
            ->groupBy('level')
            ->pluck('total', 'level')
            ->toArray();



        $allCourse = Course::where('status', 2)->get();

        return view('frontend.searchCourse', compact('course', 'category', 'selectedCategories', 'allCourse', 'selectedLevels', 'levelCounts'));
    }
}
