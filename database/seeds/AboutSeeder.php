<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutSeeder extends Seeder
{
    public function run()
    {
            $about = [
				[
                    'gambar'      => '860087174f71bf38d4f90324d76f1d9c43bb7bc02.jpg',
					'judul'      => 'test1',
                    'isi' 	     => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit',
					'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
					'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
				]
			];

			foreach ($about as $abouts) {
				DB::table('about_design')->insert($abouts);
			}
    }
}
