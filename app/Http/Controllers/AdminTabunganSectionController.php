<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Savings;
use App\Models\Students;
use Illuminate\Http\Request;

class AdminTabunganSectionController extends Controller
{
    public function showAdminTabunganSection() {
        $savings = Savings::with('user.student.class')->get();

        return view('admin.tabungan', compact('savings'));
    }
}
