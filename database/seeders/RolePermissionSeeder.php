<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'membuat soal',
            'mengedit soal',
            'menghapus soal',
            'mengerjakan soal',
            'melihat soal',
        ];

        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $teacherRole = Role::create([
            'name' => 'guru',
            'guard_name' => 'web',
        ]);

        $teacherRole->givePermissionTo($permissions);

        $studentRole = Role::create([
            'name' => 'siswa',
            'guard_name' => 'web',
        ]);
        $studentRole->givePermissionTo([
            'mengerjakan soal',
            'melihat soal',
        ]);


        $teacher = User::create([
            'name' => 'Guru',
            'email' => 'guru@mail.com',
            'password' => bcrypt('password'),
        ]);

        $teacher->assignRole($teacherRole);

    }
}
