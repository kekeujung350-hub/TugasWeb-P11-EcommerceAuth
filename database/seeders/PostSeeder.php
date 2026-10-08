<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $editor = User::where('email', 'editor@example.com')->first();

        Post::factory(2)->create(['user_id' => $admin->id]);
        Post::factory(3)->create(['user_id' => $editor->id]);
    }
}
