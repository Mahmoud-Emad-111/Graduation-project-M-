<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysiotherapyCentre extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'image',
        'title',
        'address',
        'phone',
    ];
}
