<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin do Sistema',
                'email' => 'admin@transcript.ao',
                'password' => '$2y$10$qnm4.v3I73Rxmca3MXID2ubOtb29qSBDRlmuyyI.NHYxiX0gl2tOO', // adminadmin
            ],
        ]);
    }
}