<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    const ROLE_SHELTER = 'shelter';
    const ROLE_USER = 'user';

    public function register(Request $request){
        $fields = [
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
            'role' => 'required|in:' . self::ROLE_SHELTER . ',' . self::ROLE_USER,
            'contact' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ];

        if($request->role === self::ROLE_SHELTER){
            $fields['name'] = 'required';
            $fields['cover_photo'] = 'required|image|mimes:png,jpg,jpeg,webp';
        }else{
            $fields['first_name'] = 'required';
            $fields['last_name'] = 'required';
        }

        // Validate the request
        $validated = $request->validate($fields);

        if($request->hasFile('cover_photo')){
            $validated['cover_photo'] = $request->file('cover_photo')->store('images/shelterImgs', 'public');
        }

        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $validated['user_id'] = $user->id;

        $userProfile = UserProfile::create($validated);

        if(!$userProfile){
            $user->delete();

            return [
                'message' => [
                    'status' => 'error',
                    'detail' => 'There seems to be a problem creating your account.',
                ],
            ];
        }

        $token = $user->createToken($user->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
            'message' => [
                'status' => 'success',
                'detail' => 'Account created. You can now log in.',
            ],
        ];
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user || !Hash::check($validated['password'], $user->password)){
            return [
                'message' => [
                    'status' => 'error',
                    'detail' => 'The provided credentials are incorrect.',
                ]
            ];
        }

        $token = $user->createToken($user->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function updatePassword(Request $request){
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $user = $request->user();

        if(!Hash::check($validated['old_password'], $user->password)){
            return [
                'message' => [
                    'status' => 'error',
                    'detail' => 'The provided old password is incorrect.',
                ]
            ];
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return [
            'message' => [
                'status' => 'success',
                'detail' => 'Password has been successfully updated.',
            ]
        ];
    }
    
    public function updateEmail(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = $request->user();

        $user->email = $validated['email'];
        $user->save();

        return [
            'message' => [
                'status' => 'success',
                'detail' => 'Email has been successfully updated.',
            ]
        ];
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        
        return [
            'message' => [
                'status' => 'success',
                'detail' => 'You have been logged out.',
            ]
        ];
    }
}
