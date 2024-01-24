<?php

namespace Tests\Feature\Professions;

use App\Profession;
use App\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterProfessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function filter_professions_by_skills()
    {
        $php = factory(Skill::class)->create(['name' => 'php']);
        $css = factory(Skill::class)->create(['name' => 'css']);

        $profession1 = factory(Profession::class)->create();
        $profession1->skills()->attach($php);

        $profession2 = factory(Profession::class)->create();
        $profession2->skills()->attach([$php->id, $css->id]);

        $profession3 = factory(Profession::class)->create();
        $profession3->skills()->attach($css);

        $response = $this->get("profesiones?skills[]={$php->id}&skills[]={$css->id}");

        $response->assertStatus(200);

        $response->assertViewCollection('professions')
            ->contains($profession2)
            ->notContains($profession1)
            ->notContains($profession3);
    }
}
