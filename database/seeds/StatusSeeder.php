<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $st1 = Status::create([
        	'status_name' => 'Pending',
        	'status_description' => '---', 
        ]);

        $st2 = Status::create([
        	'status_name' => 'Received',
        	'status_description' => '---', 
        ]);

        $st3 = Status::create([
        	'status_name' => 'Preparing/In Process',
        	'status_description' => '---', 
        ]);

        $st4 = Status::create([
        	'status_name' => 'Delivering',
        	'status_description' => '---', 
        ]);

        $st5 = Status::create([
        	'status_name' => 'Paid',
        	'status_description' => '---', 
        ]);

        $st6 = Status::create([
        	'status_name' => 'Delivered',
        	'status_description' => '---', 
        ]);

        $st7 = Status::create([
        	'status_name' => 'Approved',
        	'status_description' => '---', 
        ]);

        $st8 = Status::create([
        	'status_name' => 'Cancelled',
        	'status_description' => '---', 
        ]);

        $st9 = Status::create([
        	'status_name' => 'Declined',
        	'status_description' => '---', 
        ]);

        $st10 = Status::create([
            'status_name' => 'Done',
            'status_description' => '---', 
        ]);

        $st11 = Status::create([
            'status_name' => 'Active',
            'status_description' => '---', 
        ]);

        $st12 = Status::create([
            'status_name' => 'Inactive',
            'status_description' => '---', 
        ]);

    }
}
