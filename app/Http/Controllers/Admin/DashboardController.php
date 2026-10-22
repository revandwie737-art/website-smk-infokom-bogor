<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\News;
use App\Models\PpdbRegistration;
use App\Models\Student;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            "students" => Student::count(),
            "teachers" => Teacher::count(),
            "news" => News::count(),
            "ppdb_pending" => PpdbRegistration::where("status", "pending")->count(),
        ];

        $latestNews = News::latest()->take(5)->get();
        $latestRegistrations = PpdbRegistration::latest()->take(5)->get();
        $activities = ActivityLog::with("user")->latest()->take(10)->get();

        return view("admin.dashboard", compact("stats", "latestNews", "latestRegistrations", "activities"));
    }
}
