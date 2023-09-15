<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Asignamos valores pretederminados
        DB::table('alternativa')->insert([
            ['id' => 1, 'descripcion' => 'A1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'descripcion' => 'A2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'descripcion' => 'A3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
