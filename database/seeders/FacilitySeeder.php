<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::insert([
            [
                'name' => 'Gym Center',
                'facility_category_id' => 1,
                'long' => '123.456',
                'lat' => '78.910',
                'description' => 'A modern gym center equipped with the latest fitness machines.',
                'imageUrl' => 'https://example.com/images/gym.jpg',
            ],
            [
                'name' => 'Swimming Pool Complex',
                'facility_category_id' => 2,
                'long' => '123.789',
                'lat' => '78.234',
                'description' => 'A large swimming pool complex with multiple pools and facilities.',
                'imageUrl' => 'https://example.com/images/swimming_pool.jpg',
            ],
        ]);
    }
}
