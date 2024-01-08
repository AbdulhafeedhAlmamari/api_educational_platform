<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'studentName' =>  $this->student->name, // new  StudentResource($this->student),
            'courseName'  => $this->course->name //new  CourseResource($this->course),
        ];
    }
}
