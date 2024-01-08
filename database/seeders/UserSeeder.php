<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Eliminar imagenes usuarios
        Storage::deleteDirectory('public/users');
        Storage::makeDirectory('public/users');

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Álvaro Navarro',
            'email' => 'alvaro@thesnakebite.es',
        ]);
    }
}
