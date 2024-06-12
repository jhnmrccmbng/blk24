<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $c1 = Category::create([
        	'category_name' => 'Continental',
        	'category_description' => '---', 
        ]);

        $c2 = Category::create([
        	'category_name' => 'Italian',
        	'category_description' => '---', 
        ]);

		$c3 = Category::create([
        	'category_name' => 'Chinese',
        	'category_description' => '---', 
        ]);

        $c4 = Category::create([
        	'category_name' => 'American',
        	'category_description' => '---', 
        ]);        

    }
}
