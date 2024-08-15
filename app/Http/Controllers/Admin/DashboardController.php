<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function povertyDashboard()
    // {
    //     $poverty = DB::table('houses')
    //     ->join('civilians', 'houses.civilian_id', '=', 'civilians.id')
    //     ->select('houses.*', 'civilians.name as name')
    //     ->get();

    //     return view('admin.poverty.dashboard',compact('poverty'));
    // }

    public function povertyDashboard()
    {
        $poverty = DB::table('civilians')
            ->join('houses', 'civilians.house_id', '=', 'houses.id')
            ->join('economies', 'civilians.economy_id', '=' ,'economies.id')
            ->select('civilians.*', 'houses.lat as lat', 'houses.long as long', 'economies.*')
            ->get();


        return view('admin.poverty.dashboard', compact('poverty'));
    }
}
