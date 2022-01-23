<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Cara Install Php 8 di Linux Ubuntu',
                'slug' => 'cara-install-php-8-di-linux-ubuntu',
                'description' => 'tutorial linux ubuntu',
                'content' => 'ini adalah tutorial linux ubuntu',
                'type' => 'post',
                'status' => 'pending',
                'user_id' => '1ec5b59f732268929d09c8d9d28bcf0a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Cara Install Valet di llinux',
                'slug' => 'cara-install-valet-di-linux',
                'description' => 'tutorial linux ubuntu',
                'content' => 'ini adalah tutorial linux ubuntu yang didedikasikan untuk pendidikan di indonesia terutama dalam bidang teknologi',
                'type' => 'post',
                'status' => 'publish',
                'user_id' => '1ec5b59f732268929d09c8d9d28bcf0a',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
