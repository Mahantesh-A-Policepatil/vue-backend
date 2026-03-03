<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // example seeding of default Laravel users
        // \App\Models\User::factory(10)->create();

        // create some CRM users for the frontend demo
        \App\Models\CrmUser::factory(15)->create();
    }
}
