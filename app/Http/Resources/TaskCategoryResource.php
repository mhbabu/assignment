<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'name' => $this->name
            // 'comments'  => CommentResource::collection($this->comments), // assuming Post hasMany Comment
        ];
    }
}