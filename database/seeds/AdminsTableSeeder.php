<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
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
                'id' => 101,
                'name' => 'admin',
                'phone' => 18888888888,
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
            ],
        ];

        DB::table('admins')->insert($insertData);

        factory(\App\Models\Admin::class, 100)->create();

    }
}
