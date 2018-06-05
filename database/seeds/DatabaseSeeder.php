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
       // $this->call(ProfesionSedeer::class);
       // $this->call(UsersSedeer::class);
        $this->call(ClienteSeeder::class);
    }
}
