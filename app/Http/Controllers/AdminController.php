<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaidService;
use App\Models\Revenue;
use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $onlineUsers = DB::table('sessions')
        ->where('last_activity', '>=', Carbon::now()->subMinutes(5)->timestamp)
        ->pluck('user_id')
        ->unique()
        ->count();

        $paidUsers = PaidService::distinct('user_id')->count('user_id');

        $revenueByQuarter = Revenue::selectRaw('YEAR(created_at) as year, QUARTER(created_at) as quarter, SUM(amount) as total')
            ->groupBy('year', 'quarter')
            ->orderBy('year', 'desc')
            ->orderBy('quarter', 'desc')
            ->get();

        $totalExams = Exam::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'onlineUsers',
            'paidUsers',
            'revenueByQuarter',
            'totalExams'
        ));
    }
}
