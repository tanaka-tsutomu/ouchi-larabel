<?php
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        for ($i = 1; $i < 51; $i ++) {
            DB::table('products')->insert([
                'id' => $i,
                'product_category_id' => rand(1, 24),
                'name' => "product {$i}",
                'price' => rand(1, 500000),
                'description' => "hogehoge {$i}",
                'image_path' => null,
                'created_at' => new Datetime()
            ]);
        }
    }
}