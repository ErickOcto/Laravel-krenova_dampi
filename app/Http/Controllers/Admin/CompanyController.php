<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'owner' => 'required',
            'phone' => 'required',
        ]);

        $imageUrl = $request->file('imageUrl');
        $imageUrl->storeAs('public/company', $imageUrl->hashName());

        Company::create([
            'name' => $request->name,
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'imageUrl' => $imageUrl->hashName(),
            'owner' => $request->owner,
            'phone' => $request->phone,
        ]);

        return redirect()->route('company.index')->with(['success' => "Successfully created"]);
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
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image',
            'owner' => 'required',
            'phone' => 'required',
        ]);

        $company = Company::findOrFail($id);

        if($request->hasFile('imageUrl')){
            Storage::delete('public/company/'.$company->imageUrl);

            $imageUrl = $request->file('imageUrl');
            $imageUrl->storeAs('public/company', $imageUrl->hashName());

            $company->update([
            'name' => $request->name,
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'imageUrl' => $imageUrl->hashName(),
            'owner' => $request->owner,
            'phone' => $request->phone,
        ]);
        }else{
            $company->update([
            'name' => $request->name,
            'description' => $request->description,
            'lat' => $request->lat,
            'long' => $request->long,
            'owner' => $request->owner,
            'phone' => $request->phone,
        ]);
        }

        return redirect()->route('company.index')->with(['success' => "Successfully created"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        Storage::delete('public/company/'.$company->imageUrl);
        $company->delete();

        return redirect(route('company.index'));
    }
}
