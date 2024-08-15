<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Reward;
use App\Models\RewardCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class RewardController extends Controller
{
    public function rewardCategory(){
        $rewards = RewardCategories::all();
        return view('admin.reward.catIndex', compact('rewards'));
    }

    public function addRewardCategory(Request $request){
        RewardCategories::create([
            'name' => $request->name,
        ]);
        return redirect()->back();
    }

    public function deleteRewardCategory($id){
        RewardCategories::find($id)->delete();
        return redirect()->back();
    }

    public function reward(){
    $facilities = DB::table('facilities')
        ->join('facility_categories', 'facilities.facility_category_id', '=', 'facility_categories.id')
        ->select('facilities.*', 'facility_categories.name as category_name')
        ->get();

    $awards = DB::table('rewards')
        ->select('facility_id', DB::raw('COUNT(*) as award_count'))
        ->groupBy('facility_id')
        ->get()
        ->keyBy('facility_id');

    foreach ($facilities as $facility) {
        $facility->award_count = $awards->has($facility->id) ? $awards[$facility->id]->award_count : 0;
    }
        return view('admin.reward.index', compact('facilities'));
    }

    public function rewardDetail($id){
        $facility = Facility::find($id);

        $awardCat = RewardCategories::all();

        $awards = Reward::where('facility_id', $facility->id)
        ->join('reward_categories', 'reward_category_id', '=', 'reward_categories.id')
        ->select('rewards.*', 'reward_categories.name as reward_category_name')
        ->get();

        return view('admin.reward.detail', compact('facility', 'awards', 'awardCat'));
    }

    public function addReward(Request $request){
        Reward::create([
            'facility_id' => $request->facility_id,
            'reward_category_id' => $request->reward_category_id,
            'description' => $request->description,
        ]);
        return redirect()->back();
    }

    public function deleteReward($id){
        Reward::findOrFail($id)->delete();
        return redirect()->back();
    }
}
