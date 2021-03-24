<?php

use Illuminate\Database\Seeder;
use App\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
        	[
        		'name' => 'daotao-list',
        		'display_name' => 'Danh sách Lớp Học',
        		'description' => 'Xem danh sách lớp'
        	],
        	[
        		'name' => 'daotao-delete',
        		'display_name' => 'Xóa Lớp Học',
        		'description' => 'Xóa lớp học'
        	],
        	[
        		'name' => 'daotao-create',
        		'display_name' => 'Thêm Lớp Học',
        		'description' => 'Thêm lớp học'
        	],
        	[
        		'name' => 'daotao-edit',
        		'display_name' => 'Sửa Lớp Học',
        		'description' => 'Sửa lớp học'
        	],
            [
                'name' => 'daotao-show',
                'display_name' => 'Xem Lớp Học',
                'description' => 'Xem lớp học'
            ],
            [
                'name' => 'chucvu-list',
                'display_name' => 'Xem Chức vụ',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'chucvu-create',
                'display_name' => 'Thêm Chức vụ',
                'description' => 'Thêm'
            ],
            [
                'name' => 'chucvu-edit',
                'display_name' => 'Sửa Chức vụ',
                'description' => 'Sửa'
            ],
            [
                'name' => 'chucvu-delete',
                'display_name' => 'Xóa Chức vụ',
                'description' => 'Xóa'
            ],
            [
                'name' => 'diemdanh-list',
                'display_name' => 'Xem Điểm danh',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'diemdanh-show',
                'display_name' => 'Quản lý Điểm danh',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'diemdanh-create',
                'display_name' => 'Thêm Điểm danh',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'doitac-list',
                'display_name' => 'Xem Đối Tác',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'doitac-delete',
                'display_name' => 'Xóa Đối tác',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'doitac-create',
                'display_name' => 'Thêm Đối tác',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'doitac-edit',
                'display_name' => 'Sửa Đối tác',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'donhang-list',
                'display_name' => 'Xem Đơn hàng',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'donhang-delete',
                'display_name' => 'Xóa Đơn hàng',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'donhang-create',
                'display_name' => 'Thêm Đơn hàng',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'donhang-edit',
                'display_name' => 'Sửa Đơn hàng',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'donhang-show',
                'display_name' => 'Ghép Đơn hàng',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nganhnghe-list',
                'display_name' => 'Xem Ngành Nghề',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nganhnghe-create',
                'display_name' => 'Thêm Ngành Nghề',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nganhnghe-edit',
                'display_name' => 'Sửa Ngành Nghề',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nganhnghe-delete',
                'display_name' => 'Xóa Ngành Nghề',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nghiepdoan-list',
                'display_name' => 'Xem Nghiệp Đoàn',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nghiepdoan-create',
                'display_name' => 'Thêm Nghiệp Đoàn',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nghiepdoan-edt',
                'display_name' => 'Sửa Nghiệp Đoàn',
                'description' => 'Danh sách'
            ],
            [
                'name' => 'nghiepdoan-delete',
                'display_name' => 'Xóa Nghiệp Đoàn',
                'description' => 'Danh sách'
            ]

        
        ];


        foreach ($permission as $key => $value) {
        	Permission::create($value);
        }
    }
}