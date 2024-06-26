<?php

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
        // $this->call(UserSeeder::class);
        $this->call(\UserSeeder::class);
        $this->call(\RoleSeeder::class);
        $this->call(\CategorySeeder::class);
        $this->call(\ServiceSeeder::class);
        $this->call(\StatusSeeder::class);
        $this->call(\RestaurantSeeder::class);
        $this->call(\PaymentSeeder::class);
        $this->call(\InventorycategorySeeder::class);
    }
}
