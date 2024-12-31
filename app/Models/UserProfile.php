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

    public function account(){
        return $this->belongsTo(User::class);
    }
}
