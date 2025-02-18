<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['id' => 1, 'label' => 'Home', 'icon' => 'bi bi-house', 'url' => '/admin/home', 'active' => 1, 'son' => null, 'order' => 1, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-11 11:22:46'],
            ['id' => 2, 'label' => 'Administrativo', 'icon' => 'bi bi-speedometer', 'url' => '#', 'active' => 1, 'son' => null, 'order' => 2, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-11 11:22:46'],
            ['id' => 3, 'label' => 'Usuários', 'icon' => 'bi bi-people', 'url' => '/admin/users', 'active' => 1, 'son' => 2, 'order' => null, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-03 11:11:29'],
            ['id' => 4, 'label' => 'Perfis', 'icon' => 'bi bi-person-badge', 'url' => '/admin/roles', 'active' => 1, 'son' => 2, 'order' => null, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-03 11:11:29'],
            ['id' => 5, 'label' => 'Permissões', 'icon' => 'bi bi-lock', 'url' => '/admin/permissions', 'active' => 1, 'son' => 2, 'order' => null, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-03 11:11:29'],
            ['id' => 6, 'label' => 'Menus', 'icon' => 'bi bi-compass', 'url' => '/admin/menu', 'active' => 1, 'son' => 2, 'order' => null, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-03 11:11:29'],
            ['id' => 10, 'label' => 'Sair', 'icon' => 'bi bi-box-arrow-right', 'url' => '/admin/logout', 'active' => 1, 'son' => null, 'order' => 7, 'created_at' => '2025-02-03 11:11:29', 'updated_at' => '2025-02-11 18:56:24'],
        ]);
    }
}
