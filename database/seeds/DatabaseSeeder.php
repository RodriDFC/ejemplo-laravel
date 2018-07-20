<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
       // $this->call(ProfesionSedeer::class);
        $this->call(UsersSedeer::class);
        //$this->call(ClienteSeeder::class);
       // $this->call(ProductoSeeder::class);
    }
}
