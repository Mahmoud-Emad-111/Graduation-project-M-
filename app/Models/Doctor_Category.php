<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_Category extends Model
{
    use HasFactory;
    protected $table='doctor_categories';
    protected $fillable=[
        'Title',
    ];
    protected $hidden=[
        'updated_at',
        'created_at',
    ];

    public function Doctors(){
        return $this->hasMany(Doctor::class);
    }
}
