<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('customers')->insert([
            'name' => 'ali',
            'email' => 'ali@gmail.com',
            'phone' => '03022694034',
            'address' => 'lahore',
            'company' => 'jo jo',
        ]);
        
        DB::table('customers')->insert([
            'name' => 'shani',
            'email' => 'shani@gmail.com',
            'phone' => '0300000034',
            'address' => 'multan',
            'company' => 'bitshore',
        ]);

    }
}
