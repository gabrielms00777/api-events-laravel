<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', //visitor, staff, event_owner, admin
        'last_event_id',
        'phone',
        'position',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ownedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_users')
            ->wherePivot('role', 'owner');
    }

    public function assignedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_users')
            ->wherePivot('role', 'staff');
    }

    public function eventsAsVisitor()
    {
        return $this->belongsToMany(Event::class, 'event_visitors', 'user_id', 'event_id');
    }
}
