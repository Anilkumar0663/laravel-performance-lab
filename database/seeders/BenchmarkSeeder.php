<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\BenchmarkDataGenerator;

class BenchmarkSeeder extends Seeder
{
    private bool $fresh = true;

    public function run(): void
    {
        if ($this->fresh) {

            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            DB::table('payments')->truncate();
            DB::table('order_items')->truncate();
            DB::table('orders')->truncate();
            DB::table('products')->truncate();
            DB::table('categories')->truncate();
            DB::table('users')->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        (new BenchmarkDataGenerator())->run();
    }
}