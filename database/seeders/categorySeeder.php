<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $name = 'Category ' . $i;

            Category::create([
                'cat_name' => $name,
                'slug' => Str::slug($name),
                'user_id' => rand(2,3),
            ]);
        }
    }
}
