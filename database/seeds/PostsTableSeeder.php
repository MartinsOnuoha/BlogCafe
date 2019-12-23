<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Post::class, 20)->create()->each(function ($post) {
            App\Models\PostImage::create([
                'post_id' => $post->id,
                'post_image_path' => 'https://images.pexels.com/photos/302743/pexels-photo-302743.jpeg?cs=srgb&dl=ball-ball-shaped-blur-bubble-302743.jpg'
            ]);
        });
    }
}
