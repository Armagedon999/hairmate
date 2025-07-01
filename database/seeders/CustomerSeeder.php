<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $barbershop = User::where('role', 'barbershop')->first();
        if ($barbershop) {
            Customer::factory()->createMany([
                ['user_id' => $barbershop->id, 'name' => 'Budi', 'phone' => '08123456789'],
                ['user_id' => $barbershop->id, 'name' => 'Andi', 'phone' => '08129876543'],
            ]);
        }
    }
} 