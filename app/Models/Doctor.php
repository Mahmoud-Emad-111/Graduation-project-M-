<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard='Doctor';
    protected $fillable=[
        'name',
        'image',
        'address',
        'fees',
        'doctor_category_id',
        'email',
        'password',

    ];


    protected $hidden = [
        'password',
    ];
    public function Category(){
        return $this->belongsTo(Doctor_Category::class);
    }
}
