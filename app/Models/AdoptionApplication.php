<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdoptionApplication extends Model
{
    /** @use HasFactory<\Database\Factories\AdoptionApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'pet_id',
        'contact',
        'province',
        'city',
        'barangay',
        'adopter_description',
        'status',
    ];

    public function userProfile(){
        return $this->belongsTo(UserProfile::class);
    }

    public function pet(){
        return $this->belongsTo(Pet::class);
    }
}
