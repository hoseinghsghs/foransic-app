<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            ['name' => 'admin' ,'cellphone'=>'09130000000', 'email' => 'admin' , 'password' => bcrypt('12345678') , 'email_verified_at' => Carbon::now() ]
        ];
        User::upsert($users, ['email'], ['name', 'password', 'email_verified_at']);
    }
}
