<?php

// app/Listeners/LessonWatchedListener.php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Services\AchievementService;
use Illuminate\Contracts\Queue\ShouldQueue;

class LessonWatchedListener implements ShouldQueue
{

    public function handle(LessonWatched $event)
    {
        $user = $event->user;
        $lesson = $event->lesson;
        $user->lessons()->sync([$lesson->id => ['watched' => true]], false);
        
        // Call the AchievementService to handle lesson watched logic
        (new AchievementService)->handleLessonWatchedAchievements($user, $user->watched()->count());
    }
}
