<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profesion;

class UsersSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$profesion=Profesion::Where('titulo','desarrollador back-end')
          //  ->value('id');
        User::create([
           'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin123'),
            'role_id'=>'1'
        ]);
    }
}
