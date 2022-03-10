<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorRegcheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id','designation','expertise','certificate'
    ];

    public function user(){
        return $this->hasMany('App\User');
    }


}
