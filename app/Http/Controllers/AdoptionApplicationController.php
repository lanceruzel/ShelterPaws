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
            'contact' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'adopter_description' => 'required',
            'status' => 'required',
        ]);

        $application->update($validated);

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
