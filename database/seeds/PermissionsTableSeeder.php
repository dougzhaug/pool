<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insertData = [
            [
                'id' => 1,
                'name' => 'index',
                'title' => '首页',
                'guard_name' => 'admin',
                'pid' => 0,
                'url' => '/',
                'sort' => 0,
                'icon' => 'fa fa-home',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 100,
                'name' => 'system_manage',
                'title' => '后台系统管理',
                'guard_name' => 'admin',
                'pid' => 0,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-gears',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 后台管理员管理(admin) */
            [
                'id' => 1000,
                'name' => 'admins.index',
                'title' => '管理员管理',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => '',
                'sort' => 3,
                'icon' => 'fa fa-user',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1001,
                'name' => 'admins.create',
                'title' => '添加管理员',
                'guard_name' => 'admin',
                'pid' => 1000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1002,
                'name' => 'admins.show',
                'title' => '展示管理员',
                'guard_name' => 'admin',
                'pid' => 1000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1003,
                'name' => 'admins.edit',
                'title' => '修改管理员',
                'guard_name' => 'admin',
                'pid' => 1000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1004,
                'name' => 'admins.destroy',
                'title' => '删除管理员',
                'guard_name' => 'admin',
                'pid' => 1000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1005,
                'name' => 'admins.status',
                'title' => '切换管理员状态',
                'guard_name' => 'admin',
                'pid' => 1000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 后台角色管理(admin) */
            [
                'id' => 2000,
                'name' => 'roles.index',
                'title' => '角色管理',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => 'roles',
                'sort' => 2,
                'icon' => 'fa fa-puzzle-piece',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2001,
                'name' => 'roles.create',
                'title' => '添加角色',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => 'roles/create',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2002,
                'name' => 'roles.show',
                'title' => '展示角色',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2003,
                'name' => 'roles.edit',
                'title' => '修改角色',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => 'roles/edit',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2004,
                'name' => 'roles.destroy',
                'title' => '删除角色',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2005,
                'name' => 'roles.status',
                'title' => '角色状态',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2006,
                'name' => 'roles.permission_tree',
                'title' => '权限节点树',
                'guard_name' => 'admin',
                'pid' => 2000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 后台权限管理(admin) */
            [
                'id' => 3000,
                'name' => 'permissions.index',
                'title' => '权限管理',
                'guard_name' => 'admin',
                'pid' => 100,
                'url' => 'permissions',
                'sort' => 1,
                'icon' => 'fa fa-sitemap',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3001,
                'name' => 'permissions.create',
                'title' => '添加权限',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => 'permissions/create',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3002,
                'name' => 'permissions.show',
                'title' => '展示权限',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3003,
                'name' => 'permissions.edit',
                'title' => '修改权限',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3004,
                'name' => 'permissions.destroy',
                'title' => '删除权限',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3005,
                'name' => 'permissions.sort',
                'title' => '排序权限',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3006,
                'name' => 'permissions.toggle_nav',
                'title' => '切换导航模式',
                'guard_name' => 'admin',
                'pid' => 3000,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 题库管理 */
            [
                'id' => 200,
                'name' => 'question.bank',
                'title' => '题库管理',
                'guard_name' => 'admin',
                'pid' => 0,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-archive',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 题目管理 */
            [
                'id' => 1200,
                'name' => 'pools.index',
                'title' => '题目管理',
                'guard_name' => 'admin',
                'pid' => 200,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-list-alt',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1201,
                'name' => 'pools.create',
                'title' => '添加题目',
                'guard_name' => 'admin',
                'pid' => 1200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1202,
                'name' => 'pools.edit',
                'title' => '修改题目',
                'guard_name' => 'admin',
                'pid' => 1200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1203,
                'name' => 'pools.destroy',
                'title' => '删除题目',
                'guard_name' => 'admin',
                'pid' => 1200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1204,
                'name' => 'pools.status',
                'title' => '切换状态',
                'guard_name' => 'admin',
                'pid' => 1200,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            //用户管理
            [
                'id' => 300,
                'name' => 'users',
                'title' => '用户管理',
                'guard_name' => 'admin',
                'pid' => 0,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-users',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1300,
                'name' => 'users.index',
                'title' => '用户',
                'guard_name' => 'admin',
                'pid' => 300,
                'url' => '',
                'sort' => 0,
                'icon' => 'fa fa-user',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1301,
                'name' => 'users.create',
                'title' => '添加用户',
                'guard_name' => 'admin',
                'pid' => 1300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1302,
                'name' => 'users.edit',
                'title' => '修改用户',
                'guard_name' => 'admin',
                'pid' => 1300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1303,
                'name' => 'users.destroy',
                'title' => '删除用户',
                'guard_name' => 'admin',
                'pid' => 1300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 1304,
                'name' => 'users.status',
                'title' => '切换状态',
                'guard_name' => 'admin',
                'pid' => 1300,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 设置自定义id起始位置 */
            [
                'id' => 10000,
                'name' => '',
                'title' => '起始ID',
                'guard_name' => '',
                'pid' => 0,
                'url' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('permissions')->insert($insertData);
    }
}
