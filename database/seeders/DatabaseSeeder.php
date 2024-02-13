<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(UserTableSeeder::class);
        $this->call(RoleAndPermissionSeeder::class);
        $this->call(EmpresaTableSeeder::class);
    }
}
