<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Profesion;
use Illuminate\Http\Request;
use App\Http\Requests\usercrear;
use App\Http\Requests\UserEditar;
use Illuminate\Validation\Rule;


class usuarioController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
        $this->middleware('verificarRoles:administrador,supervisor',['except'=>['detalle','edit','update']]);
    }


    public function usuario(Request $request){
        //dd($request->get('name'));
        $user=User::name($request->get('name'))->get();
        return view('usuarios',compact('user'));
    }
    public function detalle(User $user){//si en la ruta hay un modelo {user}.... en el metodo definir (Modelo $variable)
        //id es un parametro que se obtenia de la ruta usuarios/{id}
        //$user=User::find($id);
        $idpr=$user->profesion_id;
        if ($idpr !=null){
           $profession=Profesion::Where('id',$idpr)->value('titulo');
        }
        else{
            $profession='no tiene profesion';
        }

        $this->authorize($user);

        return view('detalleUser',compact('user','profession'));
    }
    public function createUser(){
        $professions=Profesion::all();
        return view('crearUser',compact('professions'));
    }
    public function store(){//Request $request       usercrear $data
        /**
        $data=$request->validate([
            'name' => 'required',
            'email'=>['required','email','unique:users,email'],
            'password'=>'required'
            ],[
            'name.required'=>'campo nombre es obligatorio',
            'email.required'=>'campo email es obligatorio',
            'password.required'=>'campo password es obligatorio',
            'email.email'=>'el texto que se introdujo en campo email no es un email'
       ]);**/

        $data = $this->validate(request(), [
            'name' => 'required',
            'email'=>['required','email','unique:users,email'],
            'password'=>'required',
            'profesion_id'=> ['required','not_in:seleccione una opcion']

        ],[
            'name.required'=>'campo nombre es obligatorio',
            'email.required'=>'campo email es obligatorio',
            'password.required'=>'campo password es obligatorio',
            'email.email'=>'el texto que se introdujo en campo email no es un email',
            'email.unique'=>'Ya existe un usuario con este email',
            'profesion_id.not_in'=>'seleccione una profesion'
        ]);
        $profession=Profesion::Where('titulo',$data['profesion_id'])->value('id');
        $data['profesion_id']=$profession;

        User::create([
           'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>bcrypt($data['password']),
           'profesion_id'=>$data['profesion_id']
        ]);

        return redirect()->route('usuarios');
    }
    public function edit(User $user){
        $professions=Profesion::all();
        $profession1=Profesion::Where('id',$user->profesion_id)->value('titulo');
        if ($profession1==null){
            $profession1='seleccione una opcion';
        }

        $this->authorize($user);

        return view('editUser',compact('user','profession1','professions'));//['user'=>$user]
    }
    public function update(User $user){
        $data = $this->validate(request(), [
            'name' => 'required',
            'email'=>['required','email',Rule::unique('users')->ignore($user->id)],//unique:users,email
            'password'=>'',
            'profesion_id'=> ['required','not_in:seleccione una opcion']

        ],[
            'name.required'=>'campo nombre es obligatorio',
            'email.required'=>'campo email es obligatorio',
            'password.required'=>'campo password es obligatorio',
            'email.email'=>'el texto que se introdujo en campo email no es un email',
            'email.unique'=>'Ya existe un usuario con este email',
            'profesion_id.not_in'=>'seleccione una profesion'
        ]);
        $profession=Profesion::Where('titulo',$data['profesion_id'])->value('id');
        $data['profesion_id']=$profession;

        if ($data['password'] != null){
            $data['password']=bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $this->authorize($user);

        $user->update($data);
        return redirect()->route('detalle',['user'=>$user]);
    }
    public function destroy(User $user){
        $this->authorize($user);
        $user->delete();
        return redirect()->route('usuarios');
    }
}
