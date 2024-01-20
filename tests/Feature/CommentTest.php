<?php

namespace Tests\Feature;

use App\Events\CommentWritten;
use App\Listeners\CommentWrittenListener;
use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
class CommentTest extends TestCase
{
   /** 
    * @test
    */
    public function comment_test()
    {
        Event::fake();

        // Define your parameters
        $comment = Comment::find(1);
        $user = User::find(21);

        // Trigger the event
        event(new CommentWritten($comment, $user));

        Event::assertListening(CommentWritten::class, CommentWrittenListener::class);

        // Manually create an instance of the listener
        $listener = new CommentWrittenListener();

        // Assert that the listener's handle method is called with the expected parameters
        $listener->handle(new CommentWritten($comment, $user));

         Event::assertDispatched(CommentWritten::class, function ($event) use ($comment, $user) {
            return $event->comment === $comment && $event->user === $user;
        });
    }
}
