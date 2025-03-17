<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\SuperAdmin;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::factory(config('constants.FACTORY_COUNT'))->create();
        SuperAdmin::factory()->create();
    }
}
