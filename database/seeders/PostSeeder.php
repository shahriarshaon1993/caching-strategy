<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $total = 10000000;
        $chunk = 10000; // I will insert 10 thousand every time.
        $loops = $total / $chunk;

        for ($i = 0; $i < $loops; $i++) {
            $data = [];
            for ($j = 0; $j < $chunk; $j++) {
                $data[] = [
                    'user_id' => 1,
                    'title' => fake()->sentence(),
                    'description' => fake()->paragraph(),
                ];
            }
            DB::table('posts')->insert($data);

            if ($i % 10 === 0) {
                echo "Inserted " . ($i * $chunk) . " rows...\n";
            }
        }
    }
}
