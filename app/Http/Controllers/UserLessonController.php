<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use App\Services\AchievementService;
use Illuminate\Http\Request;

class UserLessonController extends Controller
{
    private $achievementService;
    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }
    public function store(User $user, Lesson $lesson)
    {
        $user->lessons()->sync([$lesson->id => ['watched' => true]], false);

        $this->achievementService->handleAchievements($user,$user->watched()->count());
        
    }
}
