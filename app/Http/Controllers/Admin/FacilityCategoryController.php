<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FacilityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = FacilityCategory::all();

        //dd($categories);
        return view('admin.facilityCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facilityCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'iconUrl' => 'required|image',
        ]);

        $iconUrl = $request->file('iconUrl');
        $iconUrl->storeAs('public/iconUrl', $iconUrl->hashName());

        FacilityCategory::create([
            'name' => $request->name,
            'iconUrl' => $iconUrl->hashName(),
        ]);

        return redirect()->route('category-facility.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $category = FacilityCategory::findOrFail($id);
        return view('admin.facilityCategory.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'iconUrl' => 'image',
        ]);
        $category = FacilityCategory::findOrFail($id);

        if($request->hasFile('iconUrl')){
            Storage::delete('public/iconUrl/'.$category->iconUrl);
            $iconUrl = $request->file('iconUrl');
            $iconUrl->storeAs('public/iconUrl', $iconUrl->hashName());

            $category->update([
            'name' => $request->name,
            'iconUrl' => $iconUrl->hashName(),
            ]);
        }else{
            $category->update([
            'name' => $request->name,
            ]);
        }
        return redirect()->route('category-facility.index')->with(['success' => "Successfully updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = FacilityCategory::findOrFail($id);
        Storage::delete('public/iconUrl/'.$category->iconUrl);
        $category->delete();
        return redirect()->back()->with(['message' => 'Berhasil menghapus']);
    }
}
