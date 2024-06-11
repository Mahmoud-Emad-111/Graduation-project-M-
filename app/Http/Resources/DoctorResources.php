<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DoctorResources extends JsonResource
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
            'image'=>asset(Storage::url($this->image)),
            'address'=>$this->address,
            'fess'=>$this->fess,
            'doctor_category_id'=>$this->doctor_category_id,
];
    }
}
