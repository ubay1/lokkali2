<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CasestudySeeder extends Seeder
{
    public function run()
    {
        $casestudy = [
            [
                'header'      => 'hello1',
                'gambar'      => '860087174f71bf38d4f90324d76f1d9c43bb7bc02.jpg',
                'judul'=> 'test1',
                'isi' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'header'      => 'hello2',
                'gambar'      => '860087174f71bf38d4f90324d76f1d9c43bb7bc02.jpg',
                'judul'=> 'test2',
                'isi' => 'Accusantium unde explicabo repellat nostrum, quis temporibus iste architecto',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ],
            [
                'header'      => 'hello3',
                'gambar'      => '860087174f71bf38d4f90324d76f1d9c43bb7bc02.jpg',
                'judul'=> 'test3',
                'isi' => 'Accusantium unde explicabo repellat nostrum, quis temporibus iste architecto',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($casestudy as $casestudys) {
            DB::table('casestudy_design')->insert($casestudys);
        }
    }
}
