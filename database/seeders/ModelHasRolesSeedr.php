<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use DB;

class ModelHasRolesSeedr extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $model_has_roles = [
        'role_id' => 1,
        'model_type' => 'App\Models\User',
        'model_id' => 1,
       ];
       DB::table('model_has_roles')->insert($model_has_roles);
    }
}
