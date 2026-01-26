<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollment = Enrollment::with('student')->orderBy('created_at', 'desc')->get();
        // dd($enrollment);
        return view('backend.enrollment.index', compact('enrollment'));
    }

    // Kích hoạt khoá học khi học viên thanh toán
    public function activate($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = '1';
        $enrollment->save();

        return response()->json(['success' => true, 'message' => 'Kích hoạt thành công']);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollment $enrollment) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
