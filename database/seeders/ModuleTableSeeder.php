<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modules')->insert([
            'module_id'  => '',
            'position'   => '1',
            'name'       => 'Configuración',
            'route'      => '#',
            'icon'       => 'bx bx-fw bxs-cog',
            'level'      => '0',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '2',
            'name'       => 'Usuarios',
            'route'      => 'user-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '3',
            'name'       => 'Universidades',
            'route'      => 'school-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '',
            'position'   => '4',
            'name'       => 'Publicaciones',
            'route'      => '#',
            'icon'       => 'bx bx-fw bxl-digitalocean',
            'level'      => '0',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '4',
            'position'   => '5',
            'name'       => 'Posts',
            'route'      => 'post-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

    }
}
