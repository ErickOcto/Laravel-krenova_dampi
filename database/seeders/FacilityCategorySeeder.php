<?php

namespace Database\Seeders;

use App\Models\FacilityCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FacilityCategory::insert([
            [
                'name' => 'TPS',
                'iconUrl' => '-',
            ],
            [
                'name' => 'Sekolah',
                'iconUrl' => '-',
            ],
            [
                'name' => 'Dinas',
                'iconUrl' => '-',
            ],
        ]);
    }
}
