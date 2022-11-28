<?php

namespace Database\Seeders;

use App\Models\Usuarios;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuarios::truncate();

        Usuarios::create([
            'nombre'           => 'Admin',
            'apellido_paterno' => 'Admin',
            'apellido_materno' => 'Admin',
            'email'            => 'admin@test.com',
            'password'         => bcrypt('pass')
        ]);
    }
}
