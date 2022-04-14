<?php

namespace Database\Seeders;

use App\Models\Customers\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::create([
            'name' => 'Customer1',
            'email' => 'customer1@app.com',
            'password' => Hash::make(123456),
            'address' => 'Gaza',
            // 'image' => '',
        ]);
    }
}
