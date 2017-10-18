<?php

use Illuminate\Database\Seeder;

class RouteGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('route_groups')->insert([
            'options'   => json_encode([
                'prefix'    =>  'manager',
                'namespace' =>  'Manager',
                'middleware'=>  ['web']
            ]),
            'desc'      =>  '管理员后台模块，路由为 /manager/{module}, 命名空间 \App\Http\Controllers\Manager'
        ]);

        // 2
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'party-build'
            ]),
            'desc'      =>  '党建专项模块， 路由为 /manager/party-build/{action}, 命名空间 \App\Http\Controllers\Manager',
        ]);

        // 3
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'study-group'
            ]),
            'desc'      =>  '学习小组模块， 路由为 /manager/study-group/{action}, 命名空间 App\Http\Controllers\Manager'
        ]);

        // 4
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'party-school'
            ]),
            'desc'      =>  '党校培训模块， 路由为 /manager/party-school/{action}, 命名空间 App\Http\Controllers\Manager'
        ]);

        // 5
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'important-files',
            ]),
            'desc'      =>  '重要文件模块， 路由为 /manager/important-files/{action}, 命名空间 App\Http\Controllers\Manager'
        ]);

        // 6
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'statistics'
            ]),
            'desc'      =>  '数据统计模块，路由为 /manager/statistics/{action}, 命名空间 \App\Http\Controllers\Manager'
        ]);

        // 7
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'notice',
            ]),
            'desc'      =>  '通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager'
        ]);

        // 8
        DB::table('route_groups')->insert([
            'parent_id' =>  7,
            'options'   => json_encode([
                'prefix'    =>  'party-school',
            ]),
            'desc'      =>  '通知公告管理模块，路由为 /manager/notice/{action},命名空间 \App\Http\Controllers\Manager'
        ]);

        // 9
        DB::table('route_groups')->insert([
            'parent_id' =>  7,
            'options'   => json_encode([
                'prefix'    =>  'add',
            ]),
            'desc'      =>  '添加公告子模块，路由为 /manager/notice/add/{action}, 命名空间 \App\Http\Controllers\Manager'
        ]);

        // 10
        DB::table('route_groups')->insert([
            'parent_id' =>  7,
            'options'   => json_encode([
                'prefix'    =>  'activity',
            ]),
            'desc'      =>  '活动通知子模块，路由为 /manager/notice/activity/{action}, 命名空间 \App\Http\Controllers\Manager'
        ]);

        // 11
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'file',
            ]),
            'desc'      =>  '文件上传下载控制'
        ]);

        // 12
        DB::table('route_groups')->insert([
            'parent_id' =>  1,
            'options'   => json_encode([
                'prefix'    =>  'auth',
                'namespace' =>  'Auth',
            ]),
            'desc'      =>  '用户权限管理'
        ]);

        // 13
        DB::table('route_groups')->insert([
            'options'   => json_encode([
                'prefix'    =>  'manager/auth',
                'namespace' =>  'Manager\Auth'
            ]),
        ]);

    }
}
