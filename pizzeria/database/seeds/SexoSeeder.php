<?php

use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        DB::table('sexo')->insert([
            ['sexo' => 'Masculino', 'activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['sexo' => 'Femenino',  'activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['sexo' => 'Otro',      'activo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
