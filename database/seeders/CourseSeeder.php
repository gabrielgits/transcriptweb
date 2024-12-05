<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => 'Economia',
                'room' => 'A.01',
                'user_id' => '1', // adminadmin
            ],
            [
                'name' => 'Contabilidade',
                'room' => 'A.02',
                'user_id' => '1', // adminadmin
            ],
            [
                'name' => 'Gestao Empresa',
                'room' => 'A.03',
                'user_id' => '1', // adminadmin
            ],
        ]);
    }
}