<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Get the user that owns the kid.
     * 
     * @return BelongsTo<User>
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include viewable kids.
     * 
     * @param  Builder  $query
     * @param  User  $user
     * @return Builder
     */
    public function scopeViewable($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }
}
