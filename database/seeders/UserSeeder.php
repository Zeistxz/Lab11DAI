<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // agregar usuario administrador
        $user = new \App\Models\User([
            'name' => 'Fabian',
            'last_name' => 'del Sistema',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
        ]);
        $user->save();
    }
}
