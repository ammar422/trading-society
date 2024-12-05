<?php

namespace Database\Seeders;

use App\Models\LiveSession;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LiveSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LiveSession::factory()->count(20)->create(); 

    }
}
