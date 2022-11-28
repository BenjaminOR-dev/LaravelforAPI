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

        $fechaHoraActual = now()->toDateTimeString();
        Usuarios::insert([
            [
                'id'               => 1,
                'nombre'           => 'Admin',
                'apellido_paterno' => 'Admin',
                'apellido_materno' => 'Admin',
                'email'            => 'admin@test.com',
                'password'         => bcrypt('pass'),
                'created_at'       => $fechaHoraActual,
                'updated_at'       => $fechaHoraActual
            ]
        ]);
    }
}
