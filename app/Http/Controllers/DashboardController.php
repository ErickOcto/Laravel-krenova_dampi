<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $projectOnProgress = DB::table('projects')->where('status', 'On Progress')->count();
        $projectFinished = DB::table('projects')->where('status', 'Completed')->count();
        $cost = DB::table('projects')->sum('cost');
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $costMonth = DB::table('projects')->where('p_start', '>=', $thirtyDaysAgo)->get()->sum('cost');

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

        $currentMonth = Carbon::now()->month;
        $previousMonth = Carbon::now()->subMonth()->month;

        $currentMonthProject = Project::select(DB::raw('SUM(cost) as total_cost'))
                        ->whereYear('p_start', '=', date('Y'))
                        ->whereMonth('p_start', '=', $currentMonth)
                        ->first();

        $previousMonthProject = Project::select(DB::raw('SUM(cost) as total_cost'))
                        ->whereYear('p_start', '=', date('Y'))
                        ->whereMonth('p_start', '=', $previousMonth)
                        ->first();

        $difference = $currentMonthProject->total_cost - $previousMonthProject->total_cost;

        if ($previousMonthProject->total_cost != 0) {
            $percentageDifference = ($difference / $previousMonthProject->total_cost) * 100;
        } else {
            $percentageDifference = 100;
        }

        $currentYear = Carbon::now()->year;

        $allProjects = Project::select(DB::raw('YEAR(p_start) as year, MONTH(p_start) as month, SUM(cost) as total_cost'))
                        ->whereYear('p_start', '=', $currentYear)
                        ->groupBy(DB::raw('YEAR(p_start)'), DB::raw('MONTH(p_start)'))
                        ->get();

        $labels = [];
        $data = [];

        foreach($allProjects as $project) {
            $monthYear = date('M Y', mktime(0, 0, 0, $project->month, 1, $project->year));
            $labels[] = $monthYear;
            $data[] = $project->total_cost;
        }

        return view('admin.index', [
            'projectOnProgress' => $projectOnProgress,
            'projectFinished' => $projectFinished,
            'projectCost' => $projectCost,
            'costMonth' => $costMonth,
            'labels' => json_encode($labels),
            'data' => json_encode($data),
            'differences' => $difference,
            'percentages' => $percentageDifference,
        ]);
    }
}
