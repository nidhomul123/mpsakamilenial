<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name'          => 'admin',
            'guard_name'    => 'web',
        ]);
        $admin->givePermissionTo([
            'user delete',
            'user update',
            'user read',
            'user create',
            'role delete',
            'role update',
            'role read',
            'role create',
            'permission delete',
            'permission update',
            'permission read',
            'permission create',
            'setting read',
            'activity read',
            'activity delete',
            'grade delete',
            'grade update',
            'grade read',
            'grade create',
            'subject delete',
            'subject update',
            'subject read',
            'subject create',
            'member delete',
            'member update',
            'member read',
            'member create',
            'information delete',
            'information update',
            'information read',
            'information create',
            'exam delete',
            'exam update',
            'exam read',
            'exam create',
            'question delete',
            'question update',
            'question read',
            'question create',
            'comment delete',
            'comment update',
            'comment read',
            'comment create',
            'examanswer delete',
            'examanswer correction',
            'examanswer read',
        ]);
        $pamong = Role::create([
            'name'          => 'pamong/instruktur',
            'guard_name'    => 'web',
        ]);
        $pamong->givePermissionTo([
            'user read',
        ]);
    }
}
