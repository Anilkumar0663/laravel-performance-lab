<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class BenchmarkController extends Controller
{
    public function nPlusOne()
    {
        DB::flushQueryLog();

        DB::enableQueryLog();

        $start = microtime(true);

        $memoryStart = memory_get_usage(true);

        $orders = Order::take(1000)->get();

        foreach ($orders as $order) {
            $order->user->name;
        }

        $time = round((microtime(true) - $start) * 1000, 2);

        $memory = round(
            (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
            2
        );

        return [
            'queries' => count(DB::getQueryLog()),
            'time_ms' => $time,
            'memory_mb' => $memory,
        ];
    }


    public function eagerLoading()
    {
        DB::flushQueryLog();

        DB::enableQueryLog();

        $start = microtime(true);

        $memoryStart = memory_get_usage(true);

        $orders = Order::with('user')
            ->take(1000)
            ->get();

        foreach ($orders as $order) {
            $order->user->name;
        }

        $time = round((microtime(true) - $start) * 1000, 2);

        $memory = round(
            (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
            2
        );

        return [
            'queries' => count(DB::getQueryLog()),
            'time_ms' => $time,
            'memory_mb' => $memory,
        ];
    }


    public function withBenchmark()
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $start = microtime(true);
        $memoryStart = memory_get_usage(true);

        $orders = Order::with('user')
            ->take(1000)
            ->get();

        foreach ($orders as $order) {
            $order->user->name;
        }

        return [
            'queries' => count(DB::getQueryLog()),
            'time_ms' => round((microtime(true) - $start) * 1000, 2),
            'memory_mb' => round(
                (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
                2
            ),
        ];
    }

    public function loadBenchmark()
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $start = microtime(true);
        $memoryStart = memory_get_usage(true);

        $orders = Order::take(1000)->get();

        $orders->load('user');

        foreach ($orders as $order) {
            $order->user->name;
        }

        return [
            'queries' => count(DB::getQueryLog()),
            'time_ms' => round((microtime(true) - $start) * 1000, 2),
            'memory_mb' => round(
                (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
                2
            ),
        ];
    }


   public function chunkBenchmark()
    {
        $start = microtime(true);

        $memoryStart = memory_get_usage(true);

        $count = 0;

        Order::where('id', '<=', 50000)
            ->chunk(1000, function ($orders) use (&$count) {

                foreach ($orders as $order) {
                    $count++;
                }

            });

        return [
            'processed' => $count,
            'time_ms' => round((microtime(true) - $start) * 1000, 2),
            'memory_mb' => round(
                (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
                2
            ),
        ];
    }

    public function chunkByIdBenchmark()
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        $start = microtime(true);
        $memoryStart = memory_get_usage(true);

        $count = 0;

            Order::where('id', '<=', 50000)
            ->chunkById(1000, function ($orders) use (&$count) {

                foreach ($orders as $order) {
                    $count++;
                }

            });

        return [
            'processed' => $count,
            'queries' => count(DB::getQueryLog()),
            'time_ms' => round((microtime(true)-$start)*1000,2),
            'memory_mb' => round((memory_get_usage(true)-$memoryStart)/1024/1024,2),
        ];
    }

   public function lazyBenchmark()
{
    $start = microtime(true);

    $memoryStart = memory_get_usage(true);

    $count = 0;

    foreach (
        Order::where('id', '<=', 50000)
            ->lazy(1000) as $order
    ) {
        $count++;
    }

    return [
        'processed' => $count,
        'time_ms' => round((microtime(true) - $start) * 1000, 2),
        'memory_mb' => round(
            (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
            2
        ),
    ];
}
    public function cursorBenchmark()
{
    $start = microtime(true);

    $memoryStart = memory_get_usage(true);

    $count = 0;

    foreach (
        Order::where('id', '<=', 50000)
            ->cursor() as $order
    ) {
        $count++;
    }

    return [
        'processed' => $count,
        'time_ms' => round((microtime(true) - $start) * 1000, 2),
        'memory_mb' => round(
            (memory_get_usage(true) - $memoryStart) / 1024 / 1024,
            2
        ),
    ];
}
}