<?php

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i < 26; $i++) {
            DB::table('product_categories')->insert([
                'id' => $i,
                'name' => "category{$i}",
                'order_no' => $i,
                'created_at' => new Datetime(),
            ]);
        }
    }
}