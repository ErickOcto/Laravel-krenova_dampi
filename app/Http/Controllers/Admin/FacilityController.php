<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FacilityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name')->get();

        //dd($facilities);
        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = FacilityCategory::all();
        return view('admin.facility.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'facility_category_id' => 'required',
            'imageUrl' => 'image',
            'long' => 'required',
            'lat' => 'required',
        ]);

        $imageUrl = $request->file('imageUrl');
        $imageUrl->storeAs('public/facilities', $imageUrl->hashName());

        Facility::create([
            'name' => $request->name,
            'facility_category_id' => $request->facility_category_id,
            'long' => $request->long,
            'lat' => $request->lat,
            'imageUrl' => $imageUrl->hashName(),
            'description' => $request->description,
        ]);

        return redirect()->route('facility.index')->with(['success', "Berhasil menambahkan fasilitas"]);
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
        $facility = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name')
        ->where('facilities.id', '=', $id)
        ->first();

        $categories = FacilityCategory::all();

        return view('admin.facility.edit', compact('facility', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'facility_category_id' => 'required',
            'imageUrl' => 'image',
            'long' => 'required',
            'lat' => 'required',
        ]);

        $facility = Facility::findOrFail($id);

        if($request->hasFile('imageUrl')){
            Storage::delete('public/facilities/'.$facility->imageUrl);
            $imageUrl = $request->file('imageUrl');
            $imageUrl->storeAs('public/facilities', $imageUrl->hashName());

            $facility->update([
            'name' => $request->name,
            'facility_category_id' => $request->facility_category_id,
            'long' => $request->long,
            'lat' => $request->lat,
            'imageUrl' => $imageUrl->hashName(),
            'description' => $request->description,
            ]);
        }else{
            $facility->update([
            'name' => $request->name,
            'facility_category_id' => $request->facility_category_id,
            'long' => $request->long,
            'lat' => $request->lat,
            'description' => $request->description,
            ]);
        }
        return redirect()->route('facility.index')->with(['success' => "Successfully updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Facility::findOrFail($id)->delete();

        return redirect()->back()->with(['success', "Berhasil menghapus fasilitas"]);
    }
}
