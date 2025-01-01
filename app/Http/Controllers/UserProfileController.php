<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $fields = [
            'contact' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ];

        if($request->user()->role == 'shelter'){
            $fields['name'] = 'required';
            $fields['profile_dp'] = 'nullable|max:3072|image|mimes:png,jpg,jpeg,webp';
            $fields['cover_dp'] = 'nullable|max:3072|image|mimes:png,jpg,jpeg,webp';
        }else{
            $fields['first_name'] = 'required';
            $fields['last_name'] = 'required';
        }

        if($request->hasFile('profile_dp')){
            if($request->user()->userProfile->profile_dp){
                Storage::disk('public')->delete($request->user()->userProfile->profile_dp);
            }

            $fields['profile_dp'] = Storage::disk('public')->put('images/shelterImgs', $request->profile_dp);
        }

        if($request->hasFile('cover_dp')){
            if($request->user()->userProfile->profile_dp){
                Storage::disk('public')->delete($request->user()->userProfile->cover_dp);
            }

            $fields['cover_dp'] = Storage::disk('public')->put('images/shelterImgs', $request->cover_dp);
        }

        $validated = $request->validate($fields);

        $request->user()->userProfile->update($validated);

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Successfully updated.',
                ],
        ];
    }
}
