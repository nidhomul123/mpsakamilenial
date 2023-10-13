<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'user delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'user update', 'guard_name' => 'web']);
        Permission::create(['name' => 'user read', 'guard_name' => 'web']);
        Permission::create(['name' => 'user create', 'guard_name' => 'web']);

        Permission::create(['name' => 'role delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'role update', 'guard_name' => 'web']);
        Permission::create(['name' => 'role read', 'guard_name' => 'web']);
        Permission::create(['name' => 'role create', 'guard_name' => 'web']);

        Permission::create(['name' => 'permission delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission update', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission read', 'guard_name' => 'web']);
        Permission::create(['name' => 'permission create', 'guard_name' => 'web']);

        Permission::create(['name' => 'setting read', 'guard_name' => 'web']);

        Permission::create(['name' => 'activity read', 'guard_name' => 'web']);
        Permission::create(['name' => 'activity delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'grade delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'grade update', 'guard_name' => 'web']);
        Permission::create(['name' => 'grade read', 'guard_name' => 'web']);
        Permission::create(['name' => 'grade create', 'guard_name' => 'web']);

        Permission::create(['name' => 'subject delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'subject update', 'guard_name' => 'web']);
        Permission::create(['name' => 'subject read', 'guard_name' => 'web']);
        Permission::create(['name' => 'subject create', 'guard_name' => 'web']);

        Permission::create(['name' => 'member delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'member update', 'guard_name' => 'web']);
        Permission::create(['name' => 'member read', 'guard_name' => 'web']);
        Permission::create(['name' => 'member create', 'guard_name' => 'web']);

        Permission::create(['name' => 'information delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'information update', 'guard_name' => 'web']);
        Permission::create(['name' => 'information read', 'guard_name' => 'web']);
        Permission::create(['name' => 'information create', 'guard_name' => 'web']);

        Permission::create(['name' => 'exam delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'exam update', 'guard_name' => 'web']);
        Permission::create(['name' => 'exam read', 'guard_name' => 'web']);
        Permission::create(['name' => 'exam create', 'guard_name' => 'web']);

        Permission::create(['name' => 'question delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'question update', 'guard_name' => 'web']);
        Permission::create(['name' => 'question read', 'guard_name' => 'web']);
        Permission::create(['name' => 'question create', 'guard_name' => 'web']);

        Permission::create(['name' => 'comment delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'comment update', 'guard_name' => 'web']);
        Permission::create(['name' => 'comment read', 'guard_name' => 'web']);
        Permission::create(['name' => 'comment create', 'guard_name' => 'web']);

        Permission::create(['name' => 'examanswer delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'examanswer correction', 'guard_name' => 'web']);
        Permission::create(['name' => 'examanswer read', 'guard_name' => 'web']);
    }
}
