<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentsSiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'  => $this->user_id,
            'type_user'   => $this->type_user,
            'comment'     => $this->comment,
            'status'      => $this->status,
            'degree'      => $this->degree
        ];
    }
}
