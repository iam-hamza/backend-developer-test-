<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlockedEvent;
use App\Models\User;
use App\Models\UserBadge;

class BadgeService
{
/**
 * Handle the unlocking of badges for a user based on achievements count.
 *
 * @param User $user
 * @param int  $achievementsCount
 */
public function handleBadgeUnlock(User $user, $achievementsCount)
{
    // Iterate through each badge level
    foreach (UserBadge::BADGE as $badge) {
        // Check if the achievements count matches the predefined count for the badge level
        if ($achievementsCount === UserBadge::BADGE_LEVELS[$badge]) {
            // Unlock the badge achievement and return
            $this->unlockAchievement($user, $badge);
            return;
        }
    }
}

/**
 * Unlock a badge achievement for a user and trigger the BadgeUnlockedEvent.
 *
 * @param User   $user
 * @param string $badgeName
 */
private static function unlockAchievement(User $user, $badgeName)
{
    // Trigger the BadgeUnlockedEvent to notify the application of the unlocked badge
    event(new BadgeUnlockedEvent($user, $badgeName));

    // Create a record in the badges table for the unlocked badge
    $user->badges()->create(['name' => $badgeName]);
}

}
