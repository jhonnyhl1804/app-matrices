<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Asignamos valores pretederminados
        DB::table('estado')->insert([
            ['id' => 1, 'descripcion' => 'E1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'descripcion' => 'E2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'descripcion' => 'E3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
