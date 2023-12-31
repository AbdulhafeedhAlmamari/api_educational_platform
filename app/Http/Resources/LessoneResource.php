<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LessoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'course'   =>   $this->course->name,  //new CourseResource($this->course) ,
            'extension'   => $this->extension,
            'description' => $this->description
        ];
    }
}
