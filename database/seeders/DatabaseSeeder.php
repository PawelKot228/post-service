<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);

         \App\Models\User::factory(25)->create();

         $users = User::all();

         foreach ($users as $user) {
             $user->posts()->saveMany(
                 Post::factory(8)->make()
             );
         }

         foreach (Post::all() as $post) {
             $post->comments()->saveMany(
                 Comment::factory(5)
                     ->make()
                 ->each(fn(Comment $comment) => $comment->user_id = $users->random()->id)
             );
         }
    }
}
