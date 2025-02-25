<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'Title',
    ];
    protected $hidden=[
        'updated_at',
        'created_at',
    ];

    public function Lab(){
        return $this->hasMany(Lab::class);
    }
}
