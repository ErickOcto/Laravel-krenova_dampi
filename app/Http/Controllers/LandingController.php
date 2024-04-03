<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){
        return view('landing.index');
    }

    public function facilities(){
        $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name', 'facility_categories.iconUrl as iconUrl')
        ->get();

        return view('landing.facility', compact('facilities'));
    }
}
