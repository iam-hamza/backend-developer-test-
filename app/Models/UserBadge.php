<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['name', 'user_id'];

    // Constants defining badge names
    public const BADGE = [
        0 => 'Beginner',
        1 => 'Intermediate',
        2 => 'Advance',
        3 => 'Master',
    ];

    // Corresponding achievement count for each badge level
    public const BADGE_LEVELS = [
        'Beginner' => 0,
        'Intermediate' => 4,
        'Advanced' => 8,
        'Master' => 10,
    ];

    /**
     * Define a relationship between UserBadge and User models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
