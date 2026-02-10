<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        Package::create([
            'name' => 'SIY - Single Snap!',
            'duration_minutes' => 15,
            'price' => 30.00,
            'pax_min' => 1,
            'pax_max' => 1,
            'description' => '15 minutes session for 1 person only.',
            'is_active' => true
        ]);

        Package::create([
            'name' => 'SIY - Double Play!',
            'duration_minutes' => 15,
            'price' => 45.00,
            'pax_min' => 2,
            'pax_max' => 3,
            'description' => '15 minutes session for 2-3 persons only.',
            'is_active' => true
        ]);

        Package::create([
            'name' => 'SIY - Family Fiesta!',
            'duration_minutes' => 25,
            'price' => 60.00,
            'pax_min' => 1,
            'pax_max' => 5,
            'description' => '25 minutes session for 1-5 persons only.',
            'is_active' => true
        ]);
    }
}

