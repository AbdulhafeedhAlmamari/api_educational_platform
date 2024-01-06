<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher' => new TeacherResource($this->teacher),
            'category_sub' => new CategorySubResource($this->categorySub),
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'price' => $this->price,
            'discount' => $this->discount,
            'url_image' => $this->url_image,
            'status' => $this->status,
        ];
    }
}
