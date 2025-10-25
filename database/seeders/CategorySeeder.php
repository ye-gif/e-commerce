<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Handbags / Purses',
            'Tote Bags',
            'Backpacks',
            'Messenger Bags',
            'Clutches',
            'Satchels',
            'Hobo Bags',
            'Bucket Bags',
            'Duffel / Gym Bags',
            'Laptop / Work Bags',
            'Crossbody Bags',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
