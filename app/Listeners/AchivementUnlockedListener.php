<?php

namespace App\Listeners;

use App\Services\BadgeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchivementUnlockedListener
{
   
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        
        // Call the BadgeService to handle badge unlocked logics
        (new BadgeService)->handleBadgeUnlock($user, $user->achievements()->count());
        
    }
}
