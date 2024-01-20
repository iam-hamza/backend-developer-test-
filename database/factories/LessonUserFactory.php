<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lesson;
use App\Models\LessonUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonUserFactory extends Factory
{
    protected $model = LessonUser::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $lesson = Lesson::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            // other attributes...
        ];
    }
}
