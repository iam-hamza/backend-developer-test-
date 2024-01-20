<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserAchievementsTest extends TestCase
{

    /** 
    * @test
    */
    public function user_achievements_route()
    {
        $user = User::find(1);
       
        // Assuming your route is properly defined in your routes/web.php or routes/api.php
        $response = $this->get("/users/{$user->id}/achievements");

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);
        
    }
}
