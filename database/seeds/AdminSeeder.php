<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Hashids\Hashids;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $Hashids = new Hashids('',6);

        $admin = [
            [
                'nama'      => 'ubay dillah',
                'email'     => 'ubay@gmail.com',
                'password'  => $Hashids->encode('123456'),
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'nama'      => 'muhammad zaki',
                'email'     => 'zaki@gmail.com',
                'password'  => $Hashids->encode('123456'),
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($admin as $admins) {
            DB::table('admin')->insert($admins);
        }
    }
}
