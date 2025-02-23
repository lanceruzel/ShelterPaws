<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'name',
        'type',
        'breed',
        'age',
        'gender',
        'description',
        'images',
        'adopted_at',
        'fixed',
        'vaccines'
    ];

    protected $casts = [
        'images' => 'string',
        'vaccines' => 'string',
    ];

    public function shelterProfile(){
        return $this->belongsTo(UserProfile::class, 'user_profile_id');
    }

    public function adoptionApplications(){
        return $this->hasMany(AdoptionApplication::class);
    }
}
