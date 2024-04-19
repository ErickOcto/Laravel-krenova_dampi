<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Civillian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PovertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $poverty = DB::table('civillians')
        ->join('economies', 'civillians.economy_id', '=', 'economies.id')
        ->join('houses', 'civillians.house_id', '=', 'houses.id')
        ->get();

        return view('admin.poverty.index',compact('poverty'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
