<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BenchmarkDataGenerator
{
    private int $totalUsers = 100000;
    private int $batchSize = 1000;
    private int $totalOrders = 1000000;
    private int $orderBatchSize = 1000;
    public function run(): void
    {
         DB::disableQueryLog();
 
        $this->seedUsers();

        $this->seedCategories();

        $this->seedProducts();

        $this->seedOrders();

        $this->seedOrderItems();

        $this->updateOrderTotals();

        $this->seedPayments();
    }

    private function seedUsers(): void
    {
        $password = Hash::make('password');

        $firstNames = [
            'Rahul','Amit','Rohit','Vikas','Ankit',
            'Mohit','Deepak','Ajay','Sandeep','Neeraj',
            'Priya','Pooja','Neha','Riya','Anjali',
            'Sneha','Kajal','Nisha','Simran','Aarti'
        ];

        $lastNames = [
            'Sharma','Verma','Singh','Kumar','Gupta',
            'Yadav','Saini','Patel','Jain','Agarwal'
        ];

        $totalBatches = (int) ceil($this->totalUsers / $this->batchSize);

        echo "Creating {$this->totalUsers} users...\n";

        for ($batch = 1; $batch <= $totalBatches; $batch++) {

            $rows = [];

            for ($i = 1; $i <= $this->batchSize; $i++) {

                $id = (($batch - 1) * $this->batchSize) + $i;

                if ($id > $this->totalUsers) {
                    break;
                }

                $first = $firstNames[array_rand($firstNames)];
                $last = $lastNames[array_rand($lastNames)];

                $rows[] = [
                    'name' => "{$first} {$last}",
                    'email' => "user{$id}@example.com",
                    'email_verified_at' => now(),
                    'password' => $password,
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('users')->insert($rows);

            unset($rows);

            gc_collect_cycles();

            $percent = round(($batch / $totalBatches) * 100);

            echo "Users : {$percent}% ({$batch}/{$totalBatches})" . PHP_EOL;
        }

        echo PHP_EOL;
        echo "✅ Users Seeded Successfully" . PHP_EOL;
    }


    private function seedCategories(): void
    {
        $categories = [
            'Electronics',
            'Fashion',
            'Books',
            'Furniture',
            'Gaming',
            'Sports',
            'Beauty',
            'Groceries',
            'Automotive',
            'Health',
            'Jewellery',
            'Kitchen',
            'Office',
            'Mobile',
            'Laptop',
            'Accessories',
            'Fitness',
            'Garden',
            'Kids',
            'Home Decor',
        ];

        $rows = [];

        foreach ($categories as $category) {

            $rows[] = [
                'name' => $category,
                'slug' => str($category)->slug(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('categories')->insert($rows);

        echo "✅ Categories Seeded\n";
    }

    private function seedProducts(): void
    {
        $totalProducts = 500000;
        $batchSize = 1000;

        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($categoryIds)) {
            throw new \Exception('Categories not found.');
        }

        $adjectives = [
            'Premium','Smart','Ultra','Pro','Lite',
            'Classic','Modern','Advanced','Wireless','Portable',
            'Digital','Gaming','Professional','Luxury','Eco'
        ];

        $products = [
            'Laptop','Keyboard','Mouse','Monitor','Chair',
            'Table','Phone','Watch','Speaker','Camera',
            'Printer','SSD','Router','Headphones','Microphone',
            'Bag','Shoes','Bottle','Fan','Power Bank'
        ];

        $totalBatches = (int) ceil($totalProducts / $batchSize);

        echo PHP_EOL;
        echo "Creating {$totalProducts} products..." . PHP_EOL;

        for ($batch = 1; $batch <= $totalBatches; $batch++) {

            $rows = [];

            for ($i = 1; $i <= $batchSize; $i++) {

                $id = (($batch - 1) * $batchSize) + $i;

                if ($id > $totalProducts) {
                    break;
                }

                $rows[] = [
                    'category_id' => $categoryIds[array_rand($categoryIds)],
                    'name' => $adjectives[array_rand($adjectives)] . ' ' .
                            $products[array_rand($products)] . " {$id}",
                    'price' => mt_rand(199, 99999),
                    'stock' => mt_rand(0, 500),
                    'active' => mt_rand(0, 100) < 95,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('products')->insert($rows);

            unset($rows);

            gc_collect_cycles();

            $percent = round(($batch / $totalBatches) * 100);

            echo "\rProducts : {$percent}% ({$batch}/{$totalBatches})";
        }

        echo PHP_EOL;
        echo "✅ Products Seeded Successfully" . PHP_EOL;
    }
    private function seedOrders(): void
    {
            $userIds = DB::table('users')->pluck('id')->toArray();

            $statuses = [
                'pending',
                'paid',
                'cancelled',
                'shipped'
            ];

            $totalBatches = (int) ceil(
                $this->totalOrders / $this->orderBatchSize
            );

            echo PHP_EOL;
            echo "Creating Orders..." . PHP_EOL;

            for ($batch = 1; $batch <= $totalBatches; $batch++) {

                $rows = [];

                for ($i = 1; $i <= $this->orderBatchSize; $i++) {

                    $current = (($batch - 1) * $this->orderBatchSize) + $i;

                    if ($current > $this->totalOrders) {
                        break;
                    }

                    $rows[] = [

                        'user_id' => $userIds[array_rand($userIds)],

                        'total' => 0,

                        'status' => $statuses[array_rand($statuses)],

                        'created_at' => now(),

                        'updated_at' => now(),
                    ];
                }

                DB::table('orders')->insert($rows);

                unset($rows);

                gc_collect_cycles();

                $percent = round(($batch / $totalBatches) * 100);

                echo "\rOrders : {$percent}% ({$batch}/{$totalBatches})";
            }

            echo PHP_EOL;

            echo "✅ Orders Completed" . PHP_EOL;
    }
    private function seedOrderItems(): void
    {
        $batchSize = 1000;

        $productIds = DB::table('products')->pluck('id')->toArray();

        echo PHP_EOL;
        echo "Creating Order Items..." . PHP_EOL;

        DB::table('orders')
            ->orderBy('id')
            ->chunkById($batchSize, function ($orders) use ($productIds) {

                $rows = [];

                foreach ($orders as $order) {

                    $items = rand(2, 6);

                    for ($i = 0; $i < $items; $i++) {

                        $price = mt_rand(200, 10000);
                        $qty = mt_rand(1, 5);

                        $rows[] = [
                            'order_id'   => $order->id,
                            'product_id' => $productIds[array_rand($productIds)],
                            'qty'        => $qty,
                            'price'      => $price,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }

                DB::table('order_items')->insert($rows);

                echo ".";
            });

        echo PHP_EOL;
        echo "✅ Order Items Seeded Successfully" . PHP_EOL;
    }

    private function updateOrderTotals(): void
    {
        echo PHP_EOL;
        echo "Updating Order Totals..." . PHP_EOL;

        DB::statement("
            UPDATE orders o
            JOIN (
                SELECT
                    order_id,
                    SUM(qty * price) AS total
                FROM order_items
                GROUP BY order_id
            ) oi
            ON oi.order_id = o.id
            SET o.total = oi.total
        ");

        echo "✅ Order Totals Updated" . PHP_EOL;
    }

    private function seedPayments(): void
    {
        $methods = [
            'upi',
            'card',
            'netbanking',
            'wallet'
        ];

        $statuses = [
            'success',
            'failed',
            'pending'
        ];

        echo PHP_EOL;
        echo "Creating Payments..." . PHP_EOL;

        DB::table('orders')
            ->orderBy('id')
            ->chunkById(1000, function ($orders) use ($methods, $statuses) {

                $rows = [];

                foreach ($orders as $order) {

                    $rows[] = [
                        'order_id' => $order->id,
                        'amount' => $order->total,
                        'method' => $methods[array_rand($methods)],
                        'status' => $statuses[array_rand($statuses)],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                DB::table('payments')->insert($rows);

                echo ".";
            });

        echo PHP_EOL;
        echo "✅ Payments Seeded Successfully" . PHP_EOL;
    }
    }

