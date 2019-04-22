<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            AdminsTableSeeder::class,
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            ModelHasRolesTablesSeeder::class,
            RoleHasPermissionsTableSeeder::class,
            SubjectsTableSeeder::class,
            UsersTableSeeder::class,
        ]);
    }
}
