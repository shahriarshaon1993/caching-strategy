<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $drivers = ['file', 'database', 'redis'];
        $page = request('page', 1);

        $results = [];
        $iterations = 100;

        foreach ($drivers as $driver) {
            config(['cache.default' => $driver]);

            $start = microtime(true);

            $posts = Cache::remember("posts_page_{$driver}_{$page}", now()->addDay(), function () {
                return DB::table('posts')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', direction: 'desc')
                    ->paginate(5000);
            });

            $end = microtime(true);

            $latency = round($end - $start, 4);

            $throughputStart = microtime(true);

            for ($i = 0; $i < $iterations; $i++) {
                Cache::get("posts_page_{$driver}_{$page}");
            }

            $throughputEnd = microtime(true);
            $duration = $throughputEnd - $throughputStart;
            $throughput = round($iterations / $duration, 2);

            $results[$driver] = [
                'driver' => $driver,
                'latency' => $latency,
                'throughput' => $throughput,
                'total_records' => $posts->total(),
                'count' => $posts->count(),
            ];
        }

        return view('posts.index', [
            'posts' => $posts,
            'results' => $results
        ]);
    }

    public function clears()
    {
        $drivers = ['file', 'database', 'redis'];

        foreach ($drivers as $driver) {
            Cache::store($driver)->flush();
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'All cache cleared successfully!');
    }
}
