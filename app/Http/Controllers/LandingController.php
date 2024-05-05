<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){
        $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name', 'facility_categories.iconUrl as iconUrl')
        ->get();

        return view('landing.index', compact('facilities'));
    }

    public function search(Request $request){
        $facilities = DB::table('facilities')
        ->where('facilities.name', 'LIKE', '%' . $request->search . '%')
        ->orWhere('facility_categories.name', 'LIKE', '%' . $request->search . '%')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name', 'facility_categories.iconUrl as iconUrl')
        ->get();

        return view('landing.index', compact('facilities'));
    }

    public function facilities(){
        $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name', 'facility_categories.iconUrl as iconUrl')
        ->get();

        return view('landing.facility', compact('facilities'));
    }

    public function projects(){
        $projects = DB::table('projects')
        ->join('companies', 'companies.id', '=', 'projects.company_id')
        ->select('projects.*', 'companies.name as companyName', 'companies.imageUrl as companyImage')
        ->get();
        return view('landing.project', compact('projects'));
    }

    public function tps(){
        $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name', 'facility_categories.iconUrl as iconUrl')
        ->where('facility_categories.name', '=', 'tps')->orWhere('facility_categories.name', '=', 'TPS')->orWhere('facility_categories.name', '=', 'Tps')
        ->get();
        return view('landing.tps', compact('facilities'));
    }
}
