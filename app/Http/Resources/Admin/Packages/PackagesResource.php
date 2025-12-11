<?php

namespace App\Http\Resources\Admin\Packages;

use Illuminate\Http\Resources\Json\JsonResource;

class PackagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'duration_days' => $this->duration_days,
            'assignable_id' => $this->assignable_id,
            'assign_type' => $this->assign_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
