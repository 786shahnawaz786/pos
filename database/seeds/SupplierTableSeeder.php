<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('suppliers')->insert([
            'name' => 'rehmat',
            'email' => 'rehmat@gmail.com',
            'phone' => '03003344556',
            'address' => 'ryk',
            'company' => 'bitshore',
        ]);
        
        DB::table('suppliers')->insert([
            'name' => 'rashid',
            'email' => 'rashid@gmail.com',
            'phone' => '030003334',
            'address' => 'multan',
            'company' => 'bitshore',
        ]);
        

        // items 

        
        DB::table('items')->insert([
            'title' => 'Computer',
            'category_id' => 1,
        ]);
        
        DB::table('categories')->insert([
            'title' => 'Electornics',
            'description' => ' All Electornics thing will be added in this category !!',
        ]);

        DB::table('items')->insert([
            'title' => 'Mouse',
            'category_id' => 1,
        ]);

        
    }
}
