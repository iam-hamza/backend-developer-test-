<?php

namespace App\Services;

use App\Models\UserAchievement;
use App\Models\UserBadge;

class BadgeCalculatorService
{
    public function calculateNextBadge($badge)
    {
        $nextIndex = isset($badge[0]) ?
                            array_search($badge[0], UserBadge::BADGE) + 1 :
                            0;
        
        return UserBadge::BADGE[$nextIndex];
    }

    // public function nextBadge()
    // {
    //     $userAchievements = $user->achievements()->count();

    //     $nextBadge = null;
    //     $remainingToUnlockNextBadge = null;

    //     foreach ($badgeLevels as $badge => $requiredAchievements) {
    //         if ($userAchievements < $requiredAchievements) {
    //             $nextBadge = $badge;
    //             $remainingToUnlockNextBadge = $requiredAchievements - $userAchievements;
    //             break;
    //         }
    //     }
    //     dd($remainingToUnlockNextBadge);

    // }

   
}
