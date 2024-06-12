<?php

use App\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $b1 = Restaurant::create([
       	'restaurant_name' => 'Main Branch Canlalay Biñan Laguna',
       	'restaurant_email' => 'blk24@mail.com',
       	'restaurant_phone' => '09998880920',
       	'restaurant_address' => 'B24 L1 Golden City Subdivision,Brgy. Canlalay,Biñan',
       	'restaurant_url' => 'https.//www.facebook.com/blk24cafe',
       	'restaurant_openhour' => '10:00AM', 
       	'restaurant_closehour' => '8:00PM', 
       	'restaurant_days' => 'Mon-Sat', 
       ]);

       $b2 = Restaurant::create([
       	'restaurant_name' => 'San Antonio',
       	'restaurant_email' => 'blk24@gmail.com',
       	'restaurant_phone' => '09998880920',
       	'restaurant_address' => 'San Antonio Foodpark Biñan Laguna',
       	'restaurant_url' => 'https://www.facebook.com/blk24cafe',
       	'restaurant_openhour' => '10:00AM', 
       	'restaurant_closehour' => '8:00PM', 
       	'restaurant_days' => 'Mon-Sat', 
       ]);

       $b2 = Restaurant::create([
       	'restaurant_name' => 'Plaza Rizal',
       	'restaurant_email' => 'blk24@gmail.com',
       	'restaurant_phone' => '09998880920',
       	'restaurant_address' => 'Plaza Rizal Biñan Laguna ',
       	'restaurant_url' => 'https://www.facebook.com/blk24cafe',
       	'restaurant_openhour' => '10:00AM', 
       	'restaurant_closehour' => '8:00PM', 
       	'restaurant_days' => 'Mon-Sat', 
       ]);
    }
}
