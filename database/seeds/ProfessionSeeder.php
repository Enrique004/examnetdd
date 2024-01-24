<?php

use App\Profession;
use App\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::create([
            'title' => 'Desarrollador Back-End'
        ]);
        Profession::create([
            'title' => 'Desarrollador Front-End'
        ]);
        Profession::create([
            'title' => 'Diseñador web'
        ]);

        foreach (range(1, 99) as $i) {
            $this->createRandomProfession();
        }
    }

    private function createRandomProfession(): void
    {
        $profession = factory(Profession::class)->create();

        $skills = Skill::all();

        $profession->skills()->attach($skills->random(rand(0, 3)));
    }
}
