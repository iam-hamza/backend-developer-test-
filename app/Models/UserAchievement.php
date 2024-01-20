<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['user_id', 'name'];

    // Constants defining lessons watched achievements
    public const LESSONS_WATCHED_ACHIEVEMENTS = [
        0 => 'First Lesson Watched',
        1 => '5 Lessons Watched',
        2 => '10 Lessons Watched',
        3 => '25 Lessons Watched',
        4 => '50 Lessons Watched',
    ];

    // Corresponding achievement count for each lessons watched achievement
    public const LEVEL_LESSONS_WATCHED_ACHIEVEMENTS = [
        'First Lesson Watched' => 1,
        '5 Lessons Watched' => 5,
        '10 Lessons Watched' => 10,
        '25 Lessons Watched' => 25,
        '50 Lessons Watched'  => 50,
    ];

    // Constants defining comments written achievements
    public const COMMENTS_WRITTEN_ACHIEVEMENTS = [
        0 => 'First Comment Written',
        1 => '3 Comments Written',
        2 => '5 Comments Written',
        3 => '10 Comments Written',
        4 => '20 Comments Written',
    ];

    /**
     * Define a relationship between UserAchievement and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
