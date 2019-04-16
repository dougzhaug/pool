<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insertData = [];

        $admin = [1,100,1000,1001,1002,1003,1004,1005,2000,2001,2002,2003,2004,2005,2006,3000,3001,3002,3003,3004,3005,3006];
        foreach ($admin as $value){
            $insertData[] = [
                'permission_id' => $value,
                'role_id' =>1
            ];
        }

//        /***模块总管理员***/
//        $agentAdmin = [10,110,1100,1110,1120,1130,1140,2100,2101,2102,2103,2104,2105,2106,3100,3101,3102,3103,3104,3105];
//        foreach ($agentAdmin as $value){
//            $insertData[] = [
//                'permission_id' => $value,
//                'role_id' =>10
//            ];
//        }
//
//        /***企业管理员***/
//        $agentAdmin = [10,110,1100,1110,1120,1130,1140,2100,2101,2102,2103,2104,2105,2106,3100,3101,3102,3103,3104,3105];
//        foreach ($agentAdmin as $value){
//            $insertData[] = [
//                'permission_id' => $value,
//                'role_id' =>110
//            ];
//        }
//
//        /***店长***/
//        $agentAdmin = [10,110,1100,1110,1120,1130,1140,2100,2101,2102,2103,2104,2105,2106,3100,3101,3102,3103,3104,3105];
//        foreach ($agentAdmin as $value){
//            $insertData[] = [
//                'permission_id' => $value,
//                'role_id' =>120
//            ];
//        }
//
//        /***员工***/
//        $agentAdmin = [10,110,1100,1110,1120,1130,1140,2100,2101,2102,2103,2104,2105,2106,3100,3101,3102,3103,3104,3105];
//        foreach ($agentAdmin as $value){
//            $insertData[] = [
//                'permission_id' => $value,
//                'role_id' =>130
//            ];
//        }

        DB::table('role_has_permissions')->insert($insertData);
    }
}
