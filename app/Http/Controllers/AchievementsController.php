<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserBadge;
use Illuminate\Http\Request;
use App\Services\AchievementCalculatorService;
use App\Services\BadgeCalculatorService;

class AchievementsController extends Controller
{
    protected $achievementCalculatorService, $badgeCalculatorService;

    public function __construct(
        AchievementCalculatorService $achievementCalculatorService,
        BadgeCalculatorService $badgeCalculatorService
    ) {
        $this->achievementCalculatorService = $achievementCalculatorService;
        $this->badgeCalculatorService = $badgeCalculatorService;
    }

    /**
     * Display the user's achievements and calculate the next available achievements and badges.
     *
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user)
    {
         // Fetch lesson achievements and comment achievements for the user
         $userLessonAchievements = $this->fetchAchievements($user, UserAchievement::LESSONS_WATCHED_ACHIEVEMENTS);
         $userCommentAchievements = $this->fetchAchievements($user, UserAchievement::COMMENTS_WRITTEN_ACHIEVEMENTS);

        // Fetch the user's latest badge
        $userBadge = $user->badges()->latest()->pluck('name');

        // Calculate the next lesson achievement
        $nextLessonAchievement = $this->achievementCalculatorService->calculateNextLessonAchievement($userLessonAchievements);

        // Calculate the next comment achievement
        $nextCommentAchievement = $this->achievementCalculatorService->calculateCommentWrittenAchievement($userCommentAchievements);

        // Calculate the next badge
        $nextBadge = $this->badgeCalculatorService->calculateNextBadge($userBadge);

        // Prepare and return the JSON response
        return response()->json([
            'unlocked_achievements' => array_merge($userLessonAchievements, $userCommentAchievements),
            'next_available_achievements' => [$nextLessonAchievement, $nextCommentAchievement],
            'current_badge' => $userBadge[0],
            'next_badge' =>  $nextBadge,
            'remaining_to_unlock_next_badge' => UserBadge::BADGE_LEVELS[$nextBadge] -  $user->achievements()->count(),
        ]);
    }

     /**
     * Fetch user achievements based on achievement names.
     *
     * @param User $user
     * @param array $achievementNames
     * @return array
     */
    private function fetchAchievements(User $user, array $achievementNames): array
    {
        return UserAchievement::where('user_id', $user->id)
            ->whereIn('name', $achievementNames)
            ->pluck('name')
            ->toArray();
    }
}
