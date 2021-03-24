<?php

use Illuminate\Database\Seeder;

class HoSoHocViensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('hoso_hocviens')->insert([
        	[
			'hoten' => 'Tran Thien Ngoan',
            'ngaysinh' => new Datetime,
            'gioitinh' => '0',
            'honnhan' => 'Doc Than',
            'benhan' => 'Tot',
            'noisinh' => 'Can Tho',
            'tuoi' => '28',
            'tongiao' => 'Phat',
            'mien'=> 'Nam',
            'dienthoai' => '0967698624',
            'dtnguoithan' => '0931336872',
            'congviec' => 0,
            'keo' => 0,
            'dua' => 0,
            'viet' => 0,
            'chieucao' => '170',
            'cannang' => '75',
            'nhommau' => 'B',
            'mattrai' => 'Tot',
            'matphai' => 'Tot',
            'diachi' => 'Can Tho',
            'anhngu' => '1',
            'nhatngu' => '1',
            'datungtoinhat' => '0',
            'conguoithantainhat' => '0',
            'mucdich' => 'Kiem Tien',
            'sotientrenthang' => '100',
            'sotientrennam' => '5000',
            'muctieu' => 'Phat Trien',
            'banglai' => '1',
            'loaixe' => '2',
            'sothich' => 'The Thao',
            'diemmanh' => 'Dam me Lap Trinh',
            'ngaydangky' => new Datetime,
            'nguoiphutrach' => 'Son',
            'nguoigioithieu' => 'Son',
	        'created_at' => new Datetime,
	        'updated_at' => new Datetime,
        	],
        ]);
    }
}
