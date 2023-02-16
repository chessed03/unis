<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'user_id'     => '1',
            'permissions' => '[{"read": [], "write": ["1"], "module_id": "2"}, {"read": [], "write": ["1"], "module_id": "3"}, {"read": [], "write": ["1"], "module_id": "5"}]',
            'created_by'  => '1-Root',
        ]);
    }
}
