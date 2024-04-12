<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::
        join('companies', 'companies.id', '=', 'projects.company_id')
        ->select('projects.*', 'companies.name as companyName')
        ->get();

        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('admin.project.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'company_id' => 'required',
            'p_start' => 'required|date',
            'p_end' => 'required|date',
            'imageUrl' => 'image',
            'long' => 'required',
            'lat' => 'required',
        ]);

        $imageUrl = $request->file('imageUrl');
        $imageUrl->storeAs('public/project', $imageUrl->hashName());

        $data = [
            'name' => $request->name,
            'company_id' => $request->company_id,
            'status' => "On Progress",
            'p_start' => $request->p_start,
            'p_end' => $request->p_end,
            'description' => $request->description,
            'address' => $request->address,
            'long' => $request->long,
            'lat' => $request->lat,
            'cost' => $request->cost,
            'imageUrl' => $imageUrl->hashName(),

        ];

        Project::create($data);

        return redirect(route('project.index'));
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
        $project = Project::findOrFail($id);
        $companies = Company::all();
        return view('admin.project.edit', compact('project', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'company_id' => 'required',
            'p_start' => 'required|date',
            'p_end' => 'required|date',
            'imageUrl' => 'image',
            'long' => 'required',
            'lat' => 'required',
        ]);

        $project = Project::findOrFail($id);

        if($request->hasFile('imageUrl')){
            Storage::delete('public/project/'.$project->imageUrl);
            $imageUrl = $request->file('imageUrl');
            $imageUrl->storeAs('public/project', $imageUrl->hashName());

            $data = [
                'name' => $request->name,
                'company_id' => $request->company_id,
                'status' => "On Progress",
                'p_start' => $request->p_start,
                'p_end' => $request->p_end,
                'description' => $request->description,
                'address' => $request->address,
                'long' => $request->long,
                'lat' => $request->lat,
                'cost' => $request->cost,
                'imageUrl' => $imageUrl->hashName(),
            ];
        }else{
            $data = [
                'name' => $request->name,
                'company_id' => $request->company_id,
                'status' => "On Progress",
                'p_start' => $request->p_start,
                'p_end' => $request->p_end,
                'description' => $request->description,
                'address' => $request->address,
                'long' => $request->long,
                'lat' => $request->lat,
                'cost' => $request->cost,
            ];
        }


        $project->update($data);

        return redirect(route('project.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        Storage::delete('public/project/'.$project->imageUrl);

        $project->delete();

        return redirect(route('project.index'));
    }
}
