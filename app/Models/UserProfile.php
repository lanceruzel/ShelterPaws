<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'first_name',
        'last_name',
        'contact',
        'province',
        'city',
        'barangay',
        'profile_dp',
        'cover_dp',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function adoptionApplications(){
        return $this->hasMany(AdoptionApplication::class);
    }

    public function pets(){
        return $this->hasMany(Pet::class);
    }
}
