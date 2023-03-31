<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $data = [
            'name'=>'admin',
            'nick_name'=>'管理员',
            'status'=>1,
            'email'=>'921491025@qq.com',
            'salt'=>uniqid(),
            'password'=>Hash::make('123456')
        ];
        $a = DB::table('admins')->insert($data);
    }
}
