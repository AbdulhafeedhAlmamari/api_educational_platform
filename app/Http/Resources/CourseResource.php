<?php

namespace App\Http\Resources;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'teacher_name' => $this->teacher->name,   //new TeacherResource($this->teacher),
            'category_name' => $this->category->name,    //new CategoryResource($this->category),
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
