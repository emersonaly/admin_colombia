<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Publio Quintero',
            'email' =>'publio.quintero@gmail.com',
            'password' => bcrypt('582855316'),
        ]);
        DB::table('users')->insert([
            'name' => 'Jeimer Pineda',
            'email' =>'yrpr93@gmail.com',
            'password' => bcrypt('24775083'),
        ]);
        DB::table('users')->insert([
            'name' => 'Emerson Aly',
            'email' =>'ramirezemerson1991@gmail.com@sistemasojos.com',
            'password' => bcrypt('123456'),
        ]);
        // factory(App\User::class)->times(10)->create();
        factory(App\Producto::class)->times(15)->create();
    }
}
