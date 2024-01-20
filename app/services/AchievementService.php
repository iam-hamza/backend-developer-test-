<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Models\User;
use App\Models\UserAchievement;

class AchievementService
{
    /**
     * Handle Lessons Watched Achievements for a user.
     *
     * @param User $user
     * @param int  $lessonsWatchedCount
     */
    public function handleLessonWatchedAchievements(User $user, $lessonsWatchedCount)
    {
        foreach (UserAchievement::LESSONS_WATCHED_ACHIEVEMENTS as $achievement) {
            // Check if the user does not have the achievement and the count matches
            if (
                !$user->hasAchievement($achievement) &&
                $lessonsWatchedCount === UserAchievement::LEVEL_LESSONS_WATCHED_ACHIEVEMENTS[$achievement]
            ) {
                // Unlock the achievement and return
                $this->unlockAchievement($user, $achievement);
                return;
            }
        }
    }

    /**
     * Handle Comment Written Achievements for a user.
     *
     * @param User $user
     * @param int  $commentsCount
     */
    public function handleCommentWrittenAchievements(User $user, $commentsCount)
    {
        // Switch statement for comment count achievements
        switch ($commentsCount) {
            case 1:
                $this->unlockAchievement($user, 'First Comment Written');
                break;

            case 3:
                $this->unlockAchievement($user, '3 Comment Written');
                break;

            case 5:
                $this->unlockAchievement($user, '5 Comment Written');
                break;

            case 10:
                $this->unlockAchievement($user, '10 Comment Written');
                break;

            case 20:
                $this->unlockAchievement($user, '20 Comment Written');
                break;

            default:
                // No achievement for the current comment count
                break;
        }
    }

    /**
     * Unlock an achievement for a user and trigger the AchievementUnlocked event.
     *
     * @param User $user
     * @param string $achievement
     */
    private function unlockAchievement(User $user, string $achievement_name)
    {
        event(new AchievementUnlocked($user, $achievement_name));
        $user->achievements()->firstOrCreate(['user_id' => $user->id, 'name' => $achievement_name], ['name' => $achievement_name]);
    }
}
