<?php

namespace Tests\Feature;

use App\Events\LessonWatched;
use App\Listeners\LessonWatchedListener;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
class LessonTest extends TestCase
{
   /** 
    * @test
    */
    public function lesson_test(): void
    {
        Event::fake();

        // Define your parameters
        $lesson = Lesson::find(10);
        $user = User::find(1);

        // Trigger the event
        event(new LessonWatched($lesson, $user));

        Event::assertListening(LessonWatched::class, LessonWatchedListener::class);

        // Manually create an instance of the listener
        $listener = new LessonWatchedListener();

        // Assert that the listener's handle method is called with the expected parameters
        $listener->handle(new LessonWatched($lesson, $user));

         Event::assertDispatched(LessonWatched::class, function ($event) use ($lesson, $user) {
            return $event->lesson === $lesson && $event->user === $user;
        });
    }
}
