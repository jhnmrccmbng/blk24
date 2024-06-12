<?php

use App\Inventory_category;
use Illuminate\Database\Seeder;

class InventorycategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ic1 = Inventory_category::create([
        	'inv_categoryname' => 'Ingredient',
        	'inv_categorydescription' => '---', 
        ]);

        $ic2 = Inventory_category::create([
        	'inv_categoryname' => 'Equipment',
        	'inv_categorydescription' => '---', 
        ]);

        $ic3 = Inventory_category::create([
        	'inv_categoryname' => 'Supplies',
        	'inv_categorydescription' => '---', 
        ]);

        $ic4 = Inventory_category::create([
        	'inv_categoryname' => 'Beverages',
        	'inv_categorydescription' => '---', 
        ]);

        $ic5 = Inventory_category::create([
        	'inv_categoryname' => 'Utensils',
        	'inv_categorydescription' => '---', 
        ]);
    }
}
