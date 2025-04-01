<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Get the kid that owns the transaction.
     * 
     * @return BelongsTo<Kid>
     */
    public function kid() : BelongsTo
    {
        return $this->belongsTo(Kid::class);
    }

    /**
     * Scope a query to only include viewable transactions.
     * 
     * @param  Builder  $query
     * @param  User  $user
     * @param  Kid  $kid
     * @return void
     */
    public function scopeViewable(Builder $query, User $user, Kid $kid)
    {
        return $query
            ->where('user_id', $user->id)
            ->where('kid_id', $kid->id);
    }
}
