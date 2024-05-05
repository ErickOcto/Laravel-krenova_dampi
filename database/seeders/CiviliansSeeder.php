<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Civillian;
use App\Models\House;
use App\Models\Economy;

class CiviliansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Loop to create multiple civilians
        for ($i = 0; $i < 25; $i++) {
            $civilianId = Civillian::insertGetId([
                'name' => $faker->name,
                'nik' => $faker->numerify('###############'), // Generates 15-digit random numbers
                'birth_date' => $faker->date,
                'gender' => $faker->randomElement(['male', 'female', 'nonbinary']),
                'marriage' => $faker->randomElement(['0', '1']),
                'total_dependents' => $faker->numberBetween(0, 10),
                'total_familymember' => $faker->numberBetween(1, 10),
                'description' => $faker->text,
                'created_at' => now()->timezone('Asia/Makassar'),
                'updated_at' => now()->timezone('Asia/Makassar'),
            ]);

            // Generate longitude and latitude around Balikpapan
            // Set koordinat pusat (1.1489°S, 116.9031°E)
            $centerLatitude = -1.1489;
            $centerLongitude = 116.9031;

            // Set radius dalam derajat (misalnya, 0.1 derajat)
            $radius = 0.2; // Sekitar 5 km

            // Generate longitude dan latitude dalam radius tersebut
            $latitude = $faker->randomFloat(6, $centerLatitude - $radius, $centerLatitude + $radius);
            $longitude = $faker->randomFloat(6, $centerLongitude - $radius, $centerLongitude + $radius);


            // Create House
            $house = House::create([
                'condition' => $faker->randomElement(['sobad', 'bad', 'good', 'sogood']),
                'wide_area' => $faker->randomFloat(2, 50, 500), // Random area between 50 to 500 square meters
                'size_house' => $faker->randomFloat(2, 20, 200), // Random size between 20 to 200 square meters
                'status' => 1,
                'totalbedroom' => $faker->numberBetween(1, 5),
                'long' => $longitude,
                'lat' => $latitude,
                'civilian_id' => $civilianId,
                'created_at' => now()->timezone('Asia/Makassar'),
                'updated_at' => now()->timezone('Asia/Makassar'),
            ]);

            // Create Economy
            $economy = Economy::create([
                'job_status' => $faker->randomElement(['freelance', 'fulltime', 'parttime', 'unemployed']),
                'monthly_income' => $faker->numberBetween(500000, 10000000), // Random income between 500000 to 10000000
                'job_category' => $faker->jobTitle,
                'monthly_spending' => $faker->numberBetween(100000, 5000000), // Random spending between 100000 to 5000000
                'poverty_status' => $faker->boolean(30), // 30% chance of being classified as poverty status
                'created_at' => now()->timezone('Asia/Makassar'),
                'updated_at' => now()->timezone('Asia/Makassar'),
                'civilian_id' => $civilianId,
            ]);

            // Update house_id and economy_id in Civilians
            Civillian::where('id', $civilianId)->update([
                'house_id' => $house->id,
                'economy_id' => $economy->id,
            ]);
        }
    }
}
