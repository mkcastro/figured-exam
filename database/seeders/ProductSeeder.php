<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * only seed on local environment
        if (App::isProduction()) {
            return false;
        }

        // * only seed product once for idempotency
        if (Product::count() > 0) {
            return false;
        }

        Product::factory()->create();
    }
}
