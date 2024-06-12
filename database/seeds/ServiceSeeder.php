<?php

use App\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $s1 = Service::create([
        	'service_name' => 'Delivery',
        	'service_description' => '---', 
        ]);

        $s2 = Service::create([
        	'service_name' => 'Pickup',
        	'service_description' => '---', 
        ]);
    }
}
