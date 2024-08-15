<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Civillian;
use App\Models\Economy;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PovertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $poverty = DB::table('civilians')
        //     ->join('economies', 'civilians.economy_id', '=', 'economies.id')
        //     ->join('houses', 'civilians.house_id', '=', 'houses.id')
        //     ->get();

        $poverty = Civillian::with('house', 'economy')->get();

        return view('admin.poverty.index', compact('poverty'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.poverty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $civilianId = DB::table('civilians')->insertGetId([
            'name' => $request->name,
            'nik' => $request->nik,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'marriage' => $request->marriage,
            'total_dependents' => $request->total_dependents,
            'total_familymember' => $request->total_familymember,
            'description' => $request->description,
            'created_at' => now()->timezone('Asia/Makassar'),
            'updated_at' => now()->timezone('Asia/Makassar'),
        ]);

        // Membuat objek House
        $house = House::create([
            'condition' => $request->condition,
            'wide_area' => $request->wide_area,
            'size_house' => $request->size_house,
            'status' => 1,
            'totalbedroom' => $request->totalbedroom,
            'long' => $request->long,
            'lat' => $request->lat,
            'civilian_id' => $civilianId, // Menggunakan ID dari Civillian yang baru saja dibuat
            'created_at' => now()->timezone('Asia/Makassar'),
            'updated_at' => now()->timezone('Asia/Makassar'),
        ]);

        // Membuat objek Economy
        $economy = Economy::create([
            'job_status' => $request->job_status,
            'monthly_income' => str_replace('.', '', $request->monthly_income),
            'job_category' => $request->job_category,
            'monthly_spending' => str_replace('.', '', $request->monthly_spending),
            'poverty_status' => $request->poverty_status,
            'created_at' => now()->timezone('Asia/Makassar'),
            'updated_at' => now()->timezone('Asia/Makassar'),
            'civilian_id' => $civilianId, // Menggunakan ID dari Civillian yang baru saja dibuat
        ]);

        // Menetapkan house_id dan economy_id di Civillian
        DB::table('civilians')->where('id', $civilianId)->update([
            'house_id' => $house->id,
            'economy_id' => $economy->id,
        ]);
        return redirect()->route('poverty.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $poverty = DB::table('civilians')
            ->where('civilians.id', $id) // Tambahkan 'civilians.' untuk membuat kolom 'id' menjadi tidak ambigu
            ->join('houses', 'civilians.house_id', '=', 'houses.id')
            ->join('economies', 'civilians.economy_id', '=', 'economies.id')
            ->select('civilians.*', 'houses.lat as lat', 'houses.long as long', 'economies.*', 'houses.*')
            ->first(); // Menggunakan first() karena hanya mengambil satu record

        return view('admin.poverty.show', compact('poverty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $poverty = Civillian::findOrFail($id);
        $poverty->load('economy', 'house');

        return view('admin.poverty.edit', compact('poverty'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Update data di tabel Civilians
        DB::table('civilians')->where('id', $id)->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'marriage' => $request->marriage,
            'total_dependents' => $request->total_dependents,
            'total_familymember' => $request->total_familymember,
            'description' => $request->description,
            'updated_at' => now()->timezone('Asia/Makassar'),
        ]);

        // Update data di tabel House
        $house = House::where('civilian_id', $id)->first();
        $house->condition = $request->condition;
        $house->wide_area = $request->wide_area;
        $house->size_house = $request->size_house;
        $house->totalbedroom = $request->totalbedroom;
        $house->long = $request->long;
        $house->lat = $request->lat;
        $house->save();

        // Update data di tabel Economy
        $economy = Economy::where('civilian_id', $id)->first();
        $economy->job_status = $request->job_status;
        $economy->monthly_income = str_replace('.', '', $request->monthly_income);
        $economy->job_category = $request->job_category;
        $economy->monthly_spending = str_replace('.', '', $request->monthly_spending);

        $gkStandard = 743084;
        $gkSedang = $gkStandard - (0.3 * $gkStandard);
        $gkEkstrem = $gkStandard - (0.5 * $gkStandard);

        if ($economy->monthly_income < $gkEkstrem * $request->total_familymember) {
            $economy->poverty_status = 2;
        } elseif ($economy->monthly_income < $gkSedang * $request->total_familymember) {
            $economy->poverty_status = 1;
        } else {
            $economy->poverty_status = 0;
        }        
        $economy->save();
        return redirect()->back()->with(['success', "Berhasil Mengubah data Penduduk"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poverty = Civillian::findOrFail($id);

        $poverty->delete();

        return redirect()->back();
    }
}
// $civilian = Civillian::create([
//     'name'    => $request->name,
//     'nik'       => $request->nik,
//     'birth_date'    => $request->birth_date,
//     'gender'        => $request->gender,
//     'marriage'      => $request->marriage,
//     'total_dependents'   => $request->total_dependents,
//     'total_familymember'        => $request->total_familymember,
//     'description'       => $request->description,
//     'house_id'      => $house->id,
//     'economy_id'     => $economy->id,
//     'created_at'    => Carbon::now()->timezone('Asia/Makassar'),
//     'updated_at'    => Carbon::now()->timezone('Asia/Makassar'),
// ]);

// $house = House::create([
//     'condition' => $request->condition,
//     'wide_area' => $request->wide_area,
//     'size_house'    => $request->size_house,
//     'status'    => $request->status,
//     'totalbedroom'  => $request->totalbedroom,
//     'long'  => $request->long,
//     'lat'   => $request->lat,
//     'civilian_id' => $civilian->id,
//     'created_at'    => Carbon::now()->timezone('Asia/Makassar'),
//     'updated_at'    => Carbon::now()->timezone('Asia/Makassar'),
// ]);

// $economy = Economy::create([
//     'job_status'    => $request->job_status,
//     'monthly_income'    => $request->monthly_income,
//     'job_category'  => $request->job_category,
//     'monthly_spending'  => $request->monthly_spending,
//     'poverty_status'    => $request->poverty_status,
//     'created_at'    => Carbon::now()->timezone('Asia/Makassar'),
//     'updated_at'    => Carbon::now()->timezone('Asia/Makassar'),
//     'civilian_id'   => $civilian->id,
// ]);