<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Add your seeder code here
        DB::table('albums')->insert([
            [
                'artist_id' => 16,
                'artist_twitter' => '@Drake',
                'artist_name' => 'Drake',
                'name' => 'Coding',
                'created_at' => Carbon::parse('2024-11-24 18:33:27'),
                'updated_at' => Carbon::parse('2024-11-24 18:33:27'),
            ],
            [
                'artist_id' => 17,
                'artist_twitter' => '@wizkhalifa',
                'artist_name' => 'Wiz Khalifa',
                'name' => 'Driving',
                'created_at' => Carbon::parse('2024-11-24 18:33:42'),
                'updated_at' => Carbon::parse('2024-11-24 18:33:42'),
            ],
            [
                'artist_id' => 14,
                'artist_twitter' => '@BrunoMars',
                'artist_name' => 'Bruno Mars',
                'name' => 'Monday\'s',
                'created_at' => Carbon::parse('2024-11-24 18:34:02'),
                'updated_at' => Carbon::parse('2024-11-24 18:34:02'),
            ],
        ]);
    }
}
