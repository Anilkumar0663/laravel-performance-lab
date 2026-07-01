<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    public function run(): void
    {
       Category::factory(20)->create();
        Product::factory(1000)->create();
        User::factory(1000)->create();

        $chunks = 10;
        $perChunk = 1000;

        for ($i = 0; $i < $chunks; $i++) {

            Order::factory($perChunk)
                ->create()
                ->each(function ($order) {

                    $items = OrderItem::factory(rand(2, 6))->make();

                    $total = 0;

                    foreach ($items as $item) {

                        $item->order_id = $order->id;
                        $item->save();

                        $total += $item->qty * $item->price;
                    }

                    $order->update([
                        'total' => $total,
                    ]);

                    Payment::factory()->create([
                        'order_id' => $order->id,
                        'amount'   => $total,
                    ]);
                });

            echo "Completed Chunk : " . ($i + 1) . PHP_EOL;

            gc_collect_cycles(); // Memory cleanup
        }
    }
}