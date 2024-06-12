<?php

use App\User;
use App\Role_user;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	// superadmin
        $user1 = User::create([
            'name' => 'Super Admin Account',
            'email' => 'blkadmin@yahoo.com',
            'password' => bcrypt('1231235252'),
            'email_verified_at' => Carbon\Carbon::now(),
            'remember_token' => base64_encode('blkadmin@yahoo.com'),
        ]);

        $user1->roles()->attach('1');

        //cashier
        $user2 = User::create([
            'name' => 'Cashier Account',
            'email' => 'cashier@yahoo.com',
            'password' => bcrypt('1231235252'),
            'email_verified_at' => Carbon\Carbon::now(),
            'remember_token' => base64_encode('cashier@yahoo.com'),
        ]);

        $user2->roles()->attach('2');

         //customer
        $user3 = User::create([
            'name' => 'John Marc Cambonga',
            'email' => 'jm@yahoo.com',
            'password' => bcrypt('1231235252'),
            'email_verified_at' => Carbon\Carbon::now(),
            'remember_token' => base64_encode('jm@yahoo.com'),
        ]);

        $user3->roles()->attach('3');
    }
}
