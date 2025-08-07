<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showAdminDashboard() {
        return view('admin.dashboard');
    }

    public function showStudentDashboard() {
        $student = Students::with('class')
                ->where('user_id', auth()->id())
                ->first(); // karena 1 user hanya punya 1 student

        return view('student.dashboard', compact('student'));
    }
}
