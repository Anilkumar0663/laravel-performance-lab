<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BenchmarkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/benchmark/n-plus-one', [BenchmarkController::class, 'nPlusOne']);
Route::get('/benchmark/eagerLoading', [BenchmarkController::class, 'eagerLoading']);

Route::get('/benchmark/with', [BenchmarkController::class, 'withBenchmark']);

Route::get('/benchmark/load', [BenchmarkController::class, 'loadBenchmark']);


Route::get('/benchmark/chunk', [BenchmarkController::class, 'chunkBenchmark']);
Route::get('/benchmark/chunk-by-id', [BenchmarkController::class, 'chunkByIdBenchmark']);

Route::get('/benchmark/lazy', [BenchmarkController::class, 'lazyBenchmark']);

Route::get('/benchmark/cursor', [BenchmarkController::class, 'cursorBenchmark']);