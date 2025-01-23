<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'description', 'location', 'max_participants', 'start_date', 'end_date', 'owner_id',];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
