<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisimisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visimisi = [
            [
                'gambar'      => '860087174f71bf38d4f90324d76f1d9c43bb7bc02.jpg',
                'isi' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
            ]
        ];

        foreach ($visimisi as $visimisis) {
            DB::table('visimisi_design')->insert($visimisis);
        }
    }
}
