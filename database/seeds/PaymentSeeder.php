<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = Payment::create([
        	'payment_name' => 'Cash',
        	'payment_description' => '---', 
        ]);

        $p2 = Payment::create([
        	'payment_name' => 'Online Payment',
        	'payment_description' => '---', 
        ]);
    }
}
