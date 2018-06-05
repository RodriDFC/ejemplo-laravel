<?php

namespace Tests\Feature;

use App\Profesion;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class usuarioTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_view_user()
    {
        $user1=factory(User::class)->create();
        factory(User::class)->create([
            'name'=>'rodri'
        ]);
        $this->actingAs($user1, 'api')
            ->get("/usuarios")
            ->assertSee('usuarios')
            ->assertSee('rodri')
            ->assertViewIs('usuarios')
            ->assertStatus(200);
        $this->assertEquals(2,User::count());
    }
    function tests_no_usuarios(){//nunca daria "no hay usuarios" porque nos estasmos autenticando
        $user1=factory(User::class)->create();
        $this->actingAs($user1, 'api')
            ->get("/usuarios")
            ->assertViewIs('usuarios');
        $this->assertEquals(1,User::count());
    }

    function tests_detalle_user(){
        $user1=factory(User::class)->create();
        $profession=factory(Profesion::class)->create([
            'id'=>'1',
            'titulo'=>'desarrollador'
        ]);
        $user=factory(User::class)->create([
            'name'=>'rodri',
            'profesion_id'=>'1'

            ]);
        $this->actingAs($user1, 'api')
            ->get('/usuarios/'.$user->id)
            ->assertSee('rodri')
            ->assertSee('desarrollador')
            ->assertStatus(200);
    }
    function test_page_create_user(){
        $this->get("/usuarios/nuevo")
            ->assertSee('Crear Usuario')
            ->assertStatus(200)
            ->assertViewIs('crearUser');

    }
    function test_create_new_user(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->post("/usuarios/guardar",[
            'name'=>'rodri',
            'email'=>'rodri@gmail.com',
            'password'=>'rodri',
            'profesion_id'=>'dev'
        ])->assertRedirect('/usuarios');
        $this->assertCredentials([
            'name'=>'rodri',
            'email'=>'rodri@gmail.com',
            'password'=>'rodri',
            'profesion_id'=>'1'
        ]);
    }
    function test_name_obligatorio_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->from('usuarios/nuevo')
                ->post('/usuarios/guardar',[
                    'name'=>'',
                    'email'=>'rodri@gmail.com',
                    'password'=>'rodri',
                    'profesion_id'=>'dev'
                ])->assertRedirect('usuarios/nuevo')
                ->assertSessionHasErrors(['name'=>'campo nombre es obligatorio']);
        //$this->assertDatabaseMissing('user',['email'=>'rodri@gmail.com']);
        $this->assertEquals(0,User::count());
    }
    function test_email_obligatorio_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/guardar',[
                'name'=>'rodri',
                'email'=>'',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0,User::count());
    }
    function test_password_obligatorio_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/guardar',[
                'name'=>'rodri',
                'email'=>'rodri@gmail.com',
                'password'=>'',
                'profesion_id'=>'dev'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);
        $this->assertDatabaseMissing('users',['email'=>'rodri@gmail.com']);
    }
    function test_email_valido_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/guardar',[
                'name'=>'rodri',
                'email'=>'correo-no-valido',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['email'=>'rodri@gmail.com']);
    }
    function test_email_unico_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        factory(User::class)->create([
            'email'=>'rodri@gmail.com'
        ]);;
        $this->from('usuarios/nuevo')
            ->post('/usuarios/guardar',[
                'name'=>'rodri',
                'email'=>'rodri@gmail.com',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1,User::count());
    }
    function test_profesion_error_create(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $this->from('usuarios/nuevo')
            ->post('/usuarios/guardar',[
                'name'=>'rodri',
                'email'=>'rodri@gmail.com',
                'password'=>'rodri',
                'profesion_id'=>'seleccione una opcion'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['profesion_id']);
        $this->assertEquals(0,User::count());
    }
    function test_page_edit_user(){
        $user=factory(User::class)->create();
        $this->get("/usuarios/{$user->id}/editar")
            ->assertSee('Editar Usuario')
            ->assertStatus(200)
            ->assertViewIs('editUser')
            ->assertViewHas('user',function ($viewUser) use ($user){
                return $viewUser->id == $user->id;
            });
    }
    function test_edit_user(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $user=factory(User::class)->create();
        $this->put("/usuarios/{$user->id}",[
            'name'=>'rodri',
            'email'=>'rodri@gmail.com',
            'password'=>'rodri',
            'profesion_id'=>'dev'
        ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name'=>'rodri',
            'email'=>'rodri@gmail.com',
            'password'=>'rodri',
            'profesion_id'=>'1'
        ]);
    }
    function test_name_obligatorio_update(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $user=factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
            'name'=>'',
            'email'=>'rodri@gmail.com',
            'password'=>'rodri',
            'profesion_id'=>'dev'
        ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name'=>'campo nombre es obligatorio']);
        $this->assertDatabaseMissing('users',['email'=>'rodri@gmail.com']);
    }
    function test_email_obligatorio_update(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $user=factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name'=>'rodri',
                'email'=>'',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['name'=>'rodri']);
    }
    function test_email_valido_update(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $user=factory(User::class)->create();
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name'=>'rodri',
                'email'=>'correo-no-valido',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['name'=>'rodri']);
    }
    function test_password_opcional_update(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $oldPassword='calve-anterior';
        $user=factory(User::class)->create([
            'password'=>bcrypt($oldPassword)
        ]);
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name'=>'rodri',
                'email'=>'rodri@gamil.com',
                'password'=>'',
                'profesion_id'=>'dev'
            ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name'=>'rodri',
            'email'=>'rodri@gamil.com',
            'password'=>$oldPassword,
            'profesion_id'=>'1'
        ]);
    }
    function test_email_mantener_update(){
        factory(Profesion::class)->create(['id'=>'1','titulo'=>'dev']);
        $user=factory(User::class)->create([
            'email'=>'ejemplo@gmail.com'
        ]);
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name'=>'rodri',
                'email'=>'ejemplo@gmail.com',
                'password'=>'147823',
                'profesion_id'=>'dev'
            ])->assertRedirect("/usuarios/{$user->id}");
        $this->assertCredentials([
            'name'=>'rodri',
            'email'=>'ejemplo@gmail.com',
            'password'=>'147823',
            'profesion_id'=>'1'
        ]);
    }
    function test_email_unique_update(){
        factory(User::class)->create(['email'=>'correo@existente.com']);
        $user=factory(User::class)->create(['email'=>'correo@ejemplo.com']);
        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}",[
                'name'=>'rodri',
                'email'=>'correo@existente.com',
                'password'=>'rodri',
                'profesion_id'=>'dev'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['name'=>'rodri']);
    }
    function test_eliminar_user(){
        $user=factory(User::class)->create();
        $this->delete("/usuarios/{$user->id}/eliminar")
            ->assertRedirect('/usuarios');
        $this->assertEquals(0,User::count());
    }
}
