<?php

namespace Database\Seeders;

use App\Models\ModelCategory;
use Illuminate\Database\Seeder;

class ModelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Refrigerators',
            'Ranges',
            'Washers',
            'Dryers',
            'Dishwasher',
            'Microwave',
            'Heater',
            'Air Conditioner',
            'Pedestal',
        ];

        foreach ($categories as $category) {
            ModelCategory::query()->updateOrInsert(
                ['name' => $category],
                [
                    'status' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
