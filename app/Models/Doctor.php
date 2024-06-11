<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'address',
        'fees',
        'doctor_category_id'
    ];

    public function Category(){
        return $this->belongsTo(Doctor_Category::class);
    }
}
