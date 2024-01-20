<?php

// app/Listeners/CommentWrittenListener.php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Services\AchievementService;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentWrittenListener implements ShouldQueue
{
  
    public function handle(CommentWritten $event)
    {
        $user = $event->user;
        
        // Call the AchievementService to handle lesson watched logic
        (new AchievementService)->handleCommentWrittenAchievements($user, $user->comments()->count());
    }
}
