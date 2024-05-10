<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            ['name'=>'Super Admin','display_name'=>'مدیر سیستم','guard_name'=>'web'],
            ['name'=>'company','display_name'=>'رده','guard_name'=>'web'],
            ['name'=>'personnel','display_name'=>'پرسنل','guard_name'=>'web'],
            ['name'=>'viewer','display_name'=>'ناظر','guard_name'=>'web'],
        ];
        Role::insert($roles);
    }
}
