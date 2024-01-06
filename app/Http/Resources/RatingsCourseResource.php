<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RatingsCourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_id'  => $this->student_id,
            'course_id'   => $this->course_id,
            'comment'     => $this->comment,
            'status'      => $this->status,
            'degree'      => $this->degree
        ];
    }
}
