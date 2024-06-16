<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'title',
        'address',
        'phone',
        'lab_category_id',

    ];
    public function Category(){
        return $this->belongsTo(LabCategory::class);
    }
}
