<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\HaircutHistory;
use Illuminate\Database\Seeder;

class HaircutHistorySeeder extends Seeder
{
    public function run(): void
    {
        $customer = Customer::first();
        if ($customer) {
            HaircutHistory::factory()->createMany([
                [
                    'customer_id' => $customer->id,
                    'date' => '2024-06-01',
                    'style' => 'Undercut',
                    'note' => 'Rapi',
                    'photo' => null,
                    'is_favorite' => false,
                ],
                [
                    'customer_id' => $customer->id,
                    'date' => '2024-05-10',
                    'style' => 'Pompadour',
                    'note' => 'Bagus',
                    'photo' => null,
                    'is_favorite' => true,
                ],
            ]);
        }
    }
} 