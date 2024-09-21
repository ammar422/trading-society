<?php

namespace Database\Seeders;

use App\Models\CourseVedio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseVedioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseVedio::factory(30)->create();
    }
}
