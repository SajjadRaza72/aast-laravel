<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * @return void
     */
    public function run()
    {
        for ($a = 1; $a <= 100; $a++) {
            factory(\App\Product::class)->create();
        }
    }
}
