<?php

namespace App\Http\Resources;

use App\Models\Doctor_Category;
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
            'fees'=>$this->fees,
            'doctor_category'=>Doctor_Category::find($this->doctor_category_id)->Title,
        ];
    }
}
