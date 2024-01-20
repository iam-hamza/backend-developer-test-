<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use App\Models\UserBadge;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $lessons = Lesson::factory()
            ->count(20)
            ->create();

        $users = User::factory()
            ->count(20)
            ->create();

        $comments = Comment::factory()
            ->count(20)
            ->create();

        User::all()->each(function (User $user) {
            $user->badges()->save(UserBadge::create(['user_id'=>$user->id,'name' => 'Beginner']));
        });
    }
}
