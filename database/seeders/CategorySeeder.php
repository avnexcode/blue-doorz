<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "luxury room",
                "slug" => "luxury-room",
            ],
            [
                "name" => "business room",
                "slug" => "business-room",
            ],
            [
                "name" => "family room",
                "slug" => "family-room",
            ],
            [
                "name" => "standard room",
                "slug" => "standard-room",
            ],
            [
                "name" => "economy room",
                "slug" => "economy-room",
            ],
        ];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => Str::slug($category['slug']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
