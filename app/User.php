<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profesion;
use App\Role;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;
    //public $timestamps=false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profesion_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function role(){
        return $this->belongsTo(Role::class);//no funciona si tiene null

    }
    public  function profesion()//profession + id en la tabla user
    {
        return $this->belongsTo(Profesion::class);
    }
    public function hasRoles(array $roles){
        foreach ($roles as $role){
            if ($this->role->name_rol == $role ){
                return true;
            }
        }
        return false;
    }
    public function isAdmin(){
        return $this->hasRoles(['administrador']);
    }

    public function scopeName($query, $name){
       if(trim($name) != ""){
            $query->where('name','like',"%$name%");
        }
    }
}
