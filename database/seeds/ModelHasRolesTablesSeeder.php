<?php

use Illuminate\Database\Seeder;

class ModelHasRolesTablesSeeder extends Seeder
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
                'role_id' => 1,
                'model_id' => 101,
                'model_type' => 'App\Models\Admin',
            ],
        ];


        DB::table('model_has_roles')->insert($insertData);
    }
}
