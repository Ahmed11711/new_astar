<?php

namespace App\Http\Resources\Admin\paper;

use Illuminate\Http\Resources\Json\JsonResource;

class paperResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
