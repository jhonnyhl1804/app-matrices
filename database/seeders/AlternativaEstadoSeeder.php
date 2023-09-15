<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AlternativaEstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternativa_estado')->insert([
            ['id' => 1, 'id_estado' => 1, 'id_alternativa' => 1, 'id_problema' => 1, 'valor' => 300, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'id_estado' => 2, 'id_alternativa' => 1, 'id_problema' => 1, 'valor' => -400, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'id_estado' => 3, 'id_alternativa' => 1, 'id_problema' => 1, 'valor' => -500, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'id_estado' => 1, 'id_alternativa' => 2, 'id_problema' => 1, 'valor' => 200, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'id_estado' => 2, 'id_alternativa' => 2, 'id_problema' => 1, 'valor' => 200, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'id_estado' => 3, 'id_alternativa' => 2, 'id_problema' => 1, 'valor' => -300, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'id_estado' => 1, 'id_alternativa' => 3, 'id_problema' => 1, 'valor' => 100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'id_estado' => 2, 'id_alternativa' => 3, 'id_problema' => 1, 'valor' => 100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'id_estado' => 3, 'id_alternativa' => 3, 'id_problema' => 1, 'valor' => 100, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

    }
}
