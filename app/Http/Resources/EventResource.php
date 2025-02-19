<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this->location,
            'max_participants' => $this->max_participants,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'owner' => new UserResource($this->owner),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
