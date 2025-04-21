<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController
{
    /**
     * Displays the homepage with product listings using different caching strategies.
     *
     * @return View
     */
    public function index(): View
    {
        // Query products without caching and measure execution time
        $startTimeNoCache = microtime(true);
        $productsNoCache = Product::query()
            ->orderBy('price')
            ->get();
        $noCacheTime = microtime(true) - $startTimeNoCache;

        // Query products using file-based cache and measure execution time
        $startTimeFileCache = microtime(true);
        $productsFileCache = Cache::store('file')->remember('products_file', 3600, function () {
            return Product::query()
                ->orderBy('price')
                ->get();
        });
        $fileCacheTime = microtime(true) - $startTimeFileCache;

        // Query products using Redis cache and measure execution time
        $startTimeRedisCache = microtime(true);
        $productsRedisCache = Cache::store('redis')->remember('products_redis', 3600, function () {
            return Product::query()
                ->orderBy('price')
                ->get();
        });
        $redisCacheTime = microtime(true) - $startTimeRedisCache;

        return view('index', compact(
            'productsNoCache',
            'noCacheTime',
            'productsFileCache',
            'fileCacheTime',
            'productsRedisCache',
            'redisCacheTime'
        ));
    }

    /**
     * Clears the cached product data from both file and Redis cache stores.
     *
     * @return string
     */
    public function clearCache(): string
    {
        // Clear file-based cache for products
        Cache::store('file')->forget('products_file');

        // Clear Redis cache for products
        Cache::store('redis')->forget('products_redis');

        return 'Cache cleared!';
    }
}
