<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $projectOnProgress = DB::table('projects')->where('status', 'On Progress')->count();
        $projectFinished = DB::table('projects')->where('status', 'Complete')->count();
        $cost = DB::table('projects')->sum('cost');
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $costMonth = DB::table('projects')->where('p_start', '>=', $thirtyDaysAgo)->get()->sum('cost');

        //dd($costMonth);

        function formatCost($cost) {
            if($cost >= 1000000000) {
                return round($cost / 1000000000, 1) . ' M';
            } elseif($cost >= 1000000) {
                return round($cost / 1000000, 1) . ' Juta';
            } elseif($cost >= 100000) {
                return round($cost / 1000, 1) . ' Ribu';
            } else {
                return number_format($cost, 0, ',', '.');
            }
        }

        $projectCost = formatCost($cost);

        $costMonth = formatCost($costMonth);
        return view('admin.index', compact('projectOnProgress', 'projectFinished', 'projectCost', 'costMonth'));
    }
}
