<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Information;
use App\Models\Member;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'members' => Member::where('status', 'diterima')->count(),
            'grades' => Grade::count(),
            'subjects' => Subject::count(),
            'informations' => Information::count(),
            'kridas' => DB::select("SELECT REPLACE(g.name, 'Krida ','') AS grade, COUNT(m.id) AS count
                FROM grades g
                LEFT JOIN members m ON g.id = m.grade_id
                GROUP BY g.name            
                "),
            'statuses' => DB::select("SELECT COUNT(CASE WHEN status = 'terdaftar' THEN id END) as terdaftar, COUNT(CASE WHEN status = 'diterima' THEN id END) as diterima, COUNT(CASE WHEN status = 'ditolak' THEN id END) as ditolak FROM members"),
        ]);
    }
}
