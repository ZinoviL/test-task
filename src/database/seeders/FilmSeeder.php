<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Film::factory(10)->has(Actor::factory()->count(3))->create();
    }
}
