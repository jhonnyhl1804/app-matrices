<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProblemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Asignamos valores pretederminados
        DB::table('problema')->insert([
            ['id' => 1, 'descripcion' => 'Problema de prueba', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}
