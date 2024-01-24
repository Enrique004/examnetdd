<?php

namespace Tests\Feature\Professions;

use App\Profession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchProfessionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function search_professions_by_title()
    {
        $programador = factory(Profession::class)->create([
            'title' => 'Programador',
        ]);

        $basurero = factory(Profession::class)->create([
            'title' => 'Basurero',
        ]);

        $this->get('profesiones?search=Programador')
            ->assertStatus(200)
            ->assertViewHas('professions', function ($professions) use ($programador, $basurero) {
                return $professions->contains($programador) && !$professions->contains($basurero);
            });
    }

    /** @test */
    function partial_search_by_title()
    {
        $programador = factory(Profession::class)->create([
            'title' => 'Programador',
        ]);

        $basurero = factory(Profession::class)->create([
            'title' => 'Basurero',
        ]);

        $this->get('profesiones?search=Prog')
            ->assertStatus(200)
            ->assertViewHas('professions', function ($professions) use ($programador, $basurero) {
                return $professions->contains($programador) && !$professions->contains($basurero);
            });
    }

    /** @test */
    function search_professions_by_sector()
    {
        $programador = factory(Profession::class)->create([
            'sector' => 'Programador',
        ]);

        $basurero = factory(Profession::class)->create([
            'sector' => 'Basurero',
        ]);

        $this->get('profesiones?search=Programador')
            ->assertStatus(200)
            ->assertViewHas('professions', function ($professions) use ($programador, $basurero) {
                return $professions->contains($programador) && !$professions->contains($basurero);
            });
    }

    /** @test */
    function partial_search_by_sector()
    {
        $programador = factory(Profession::class)->create([
            'sector' => 'Programador',
        ]);

        $basurero = factory(Profession::class)->create([
            'sector' => 'Basurero',
        ]);

        $this->get('profesiones?search=Ba')
            ->assertStatus(200)
            ->assertViewHas('professions', function ($professions) use ($programador, $basurero) {
                return $professions->contains($basurero) && !$professions->contains($programador);
            });
    }
}
