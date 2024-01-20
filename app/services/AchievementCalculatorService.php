<?php

namespace App\Services;

use App\Models\UserAchievement;

class AchievementCalculatorService
{
    public function calculateNextLessonAchievement($userLessonAchievements)
    {
        $nextIndex = isset($userLessonAchievements[0]) ?
                            array_search($userLessonAchievements[0], UserAchievement::LESSONS_WATCHED_ACHIEVEMENTS) + 1 :
                            0;
        
        return UserAchievement::LESSONS_WATCHED_ACHIEVEMENTS[$nextIndex];
    }

    public function calculateCommentWrittenAchievement($usercommentAchievements)
    {
        $nextIndex = isset($usercommentAchievements[0]) ?
                            array_search($usercommentAchievements[0], UserAchievement::COMMENTS_WRITTEN_ACHIEVEMENTS) + 1 :
                            0;
        
        return UserAchievement::COMMENTS_WRITTEN_ACHIEVEMENTS[$nextIndex];
    }
}
