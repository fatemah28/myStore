<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => "Strawberry",
            'image' => "products/strawberry.jpg",
            'price'=>"200",
            'category_id'=>1
        ]);
        DB::table('products')->insert([
            'name' => "Berry",
            'image' => "products/berry.jpg",
            'price'=>"300",
            'category_id'=>1
        ]);
        DB::table('products')->insert([
            'name' => "Kiwi",
            'image' => "products/kiwi.jpg",
            'price'=>"1000",
            'category_id'=>1
        ]);
        DB::table('products')->insert([
            'name' => "Lemon",
            'image' => "products/lemon.jpg",
            'price'=>"10",
            'category_id'=>2
        ]);
        DB::table('products')->insert([
            'name' => "Lettuce",
            'image' => "products/lettuce.png",
            'price'=>"20",
            'category_id'=>2
        ]);
        DB::table('products')->insert([
            'name' => "Cucumber",
            'image' => "products/cucumber.jpg",
            'price'=>"15",
            'category_id'=>2
        ]);
        DB::table('products')->insert([
            'name' => "Lamb",
            'image' => "products/lamb.jpg",
            'price'=>"3000",
            'category_id'=>3
        ]);
        DB::table('products')->insert([
            'name' => "Chicken",
            'image' => "products/chicken.jpg",
            'price'=>"1000",
            'category_id'=>3
        ]);
        DB::table('products')->insert([
            'name' => "Fish",
            'image' => "products/fish.jpg",
            'price'=>"5000",
            'category_id'=>3
        ]);
       
    }
}
