<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    //
    function index(Request $request){
        return User::where('role', 'shelter')->with('userProfile.pets')->get();
    }
}
