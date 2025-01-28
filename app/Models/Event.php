<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'location',
        'max_participants',
        'start_date',
        'end_date',
        'image_url',
    ];

    public function owners()
    {
        return $this->belongsToMany(User::class, 'event_users')
            ->wherePivot('role', 'owner');
    }

    public function staff()
    {
        return $this->belongsToMany(User::class, 'event_users')
            ->wherePivot('role', 'staff');
    }

    public function visitors()
    {
        return $this->belongsToMany(User::class, 'event_visitors', 'event_id', 'user_id')
            ->where('role', 'visitor');
    }
}
