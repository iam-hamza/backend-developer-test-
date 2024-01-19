<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Models\User;

class AchievementService
{
    public  function handleAchievements(User $user, $lessonsWatchedCount)
    {
        switch ($lessonsWatchedCount) {
            case 1:
                self::unlockAchievement($user, 'First Lesson Watched');
                break;

            case 5:
                self::unlockAchievement($user, '5 Lessons Watched');
                break;

            case 10:
               self::unlockAchievement($user, '10 Lessons Watched');
                break;

            case 25:
               self::unlockAchievement($user, '25 Lessons Watched');
                break;

            case 50:
               self::unlockAchievement($user, '50 Lessons Watched');
                break;

          

            default:
                // No achievement for the current lesson count
                break;
        }
    }

    private static function unlockAchievement(User $user, $achievement)
    {
        event(new AchievementUnlocked($user, $achievement));
        $user->achievements()->create(['name' => $achievement]);
    }
}
