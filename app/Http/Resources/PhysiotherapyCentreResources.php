<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhysiotherapyCentreResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'title'=>$this->title,
            'image'=>asset(Storage::url($this->image)),
            'phone'=>$this->phone,
            'address'=>$this->address,
        ];
    }
}
