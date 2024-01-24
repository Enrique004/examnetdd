<?php

namespace Tests\Feature\Admin;

use App\Profession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProfessionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_professions_list()
    {
        factory(Profession::class)->create(['title' => 'Diseñador']);
        factory(Profession::class)->create(['title' => 'Programador']);
        factory(Profession::class)->create(['title' => 'Administrador']);

        $this->get('profesiones')
            ->assertStatus(200)
            ->assertSeeInOrder([
                'Administrador',
                'Diseñador',
                'Programador',
            ]);
    }

    /** @test */
    function it_shows_a_default_message_if_the_professions_list_is_empty()
    {
        $this->get('profesiones?empty')
            ->assertStatus(200)
            ->assertSee(trans('Listado de profesiones'))
            ->assertSee('No hay profesiones');
    }

    /** @test */
    function it_paginates_the_professions()
    {
        factory(Profession::class)->create([
            'title' => 'A'
        ]);

        factory(Profession::class)->create([
            'title' => 'C'
        ]);

        factory(Profession::class)->create([
            'title' => 'B'
        ]);

        factory(Profession::class)->create([
            'title' => 'E'
        ]);

        factory(Profession::class)->create([
            'title' => 'D'
        ]);

        factory(Profession::class)->create([
            'title' => 'G'
        ]);

        factory(Profession::class)->create([
            'title' => 'F'
        ]);

        factory(Profession::class)->create([
            'title' => 'I'
        ]);

        factory(Profession::class)->create([
            'title' => 'H'
        ]);

        factory(Profession::class)->create([
            'title' => 'K'
        ]);

        factory(Profession::class)->create([
            'title' => 'J'
        ]);

        factory(Profession::class)->create([
            'title' => 'L'
        ]);

        $this->get('profesiones')
            ->assertStatus(200)
            ->assertSeeInOrder([
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I',
                'J'
            ])
            ->assertDontSee('Segundo usuario')
            ->assertDontSee('Primer usuario');

        $this->get('profesiones?page=2')
            ->assertSeeInOrder([
                'K',
                'L',
            ]);
    }

    /** @test */
    function professions_are_ordered_by_title()
    {
        factory(Profession::class)->create(['title' => 'Arquitecto']);
        factory(Profession::class)->create(['title' => 'Constructor']);
        factory(Profession::class)->create(['title' => 'Basurero']);

        $this->get('profesiones')
            ->assertSeeInOrder([
                'Arquitecto',
                'Basurero',
                'Constructor'
            ]);
    }

}
