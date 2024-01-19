<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'name' =>$this->name,
        'email' =>$this->email,
        'gender' =>$this->gender,
        'phone_number' =>$this->phone_number,
        'address' =>$this->address,
        // 'password' =>$this->password,
        'url_image' =>$this->url_image,
        'status' =>$this->status,
        ];
    }
}
