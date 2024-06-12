<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $superadmin = Role::create([
        	'role_name' => 'SuperAdmin',
        	'slug' => 'superadmin', 
        	'permissions' => json_encode([
        		'overall-functions' => true, 
        	]),
        ]);

        $cashier = Role::create([
        	'role_name' => 'Cashier',
        	'slug' => 'cashier',
        	'permissions' =>json_encode([
        		'cashier-functions' => true,
        	]),
        ]);

        $customer = Role::create([
        	'role_name' => 'Customer',
        	'slug' => 'customer',
        	'permissions' =>json_encode([
        		'customer-functions' => true,
        	]),
        ]);

        $delivery = Role::create([
            'role_name' => 'Delivery',
            'slug' => 'delivery',
            'permissions' =>json_encode([
                'delivery-functions' => true,
            ]),
        ]);
    }
}
