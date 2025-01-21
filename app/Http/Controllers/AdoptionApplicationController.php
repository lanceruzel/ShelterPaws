<?php

namespace App\Http\Controllers;

use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->user()->role === 'admin'){
            return AdoptionApplication::with(['pet.shelterProfile', 'userProfile'])->get();
        }else if($request->user()->role === 'shelter'){
            $userProfileId = $request->user()->userProfile->id;

            return AdoptionApplication::with(['pet.shelterProfile', 'userProfile'])
            ->whereHas('pet', function ($query) use ($userProfileId) {
                $query->where('user_profile_id', $userProfileId);
            })
            ->get();
        }

        return $request->user()->userProfile->adoptionApplications()->with('pet.shelterProfile')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'contact' => 'required',
            'adopter_description' => 'required',
        ]);


        //Check if user already have an exisitng application with the selected pet
        if(AdoptionApplication::where('pet_id', $validated['pet_id'])->where('user_profile_id', $request->user()->userProfile->id)->exists()){
            return response()->json([
                'message' => [
                    'status' => 'error',
                    'detail' => 'You have already submitted an application for this pet.',
                ],
            ], 400);
        }

        AdoptionApplication::create([
            'pet_id' => $validated['pet_id'],
            'user_profile_id' => $request->user()->userProfile->id,
            'contact' => $validated['contact'],
            'adopter_description' => $validated['adopter_description'],
            'province' => $request->user()->userProfile->province,
            'city' => $request->user()->userProfile->city,
            'barangay' => $request->user()->userProfile->barangay,
        ]);

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Your application has been submitted.',
                ],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(AdoptionApplication $application)
    {
        return $application;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdoptionApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        $application->status = $validated['status'];
        $application->save();

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Adoption application has been successfully updated.',
                ],
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdoptionApplication $application)
    {
        $application->delete();

        return [
            'message' => [
                    'status' => 'Application has been successfully deleted.',
                ],
        ];
    }
}
