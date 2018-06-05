<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class inicioTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_inicio(){
        $user=factory(User::class)->create();
        $this->actingAs($user, 'api')
            -> get("/")
            ->assertSee('laravel')
            ->assertSee('Usuarios')
             ->assertStatus(200);
    }
    public function test_errors_404(){
        $this->get("/pagina/no/existente")//una ruta que no exixte en el sitio Web
            ->assertSee('Pagina no Encontrada')
            ->assertStatus(404);
    }
}
