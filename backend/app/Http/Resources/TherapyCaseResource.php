<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class TherapyCaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'diagnosis' => $this->diagnosis,
            'age' => Carbon::parse($this->age)->age,
            'name' => $this->name,
            'users' => UserResource::collection($this->whenLoaded('users'))
        ];
    }
}
