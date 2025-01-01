<?php

namespace App\Http\Controllers;

use App\Models\AdoptionApplication;
use Illuminate\Http\Request;

class AdoptionApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AdoptionApplication::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'contact' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'adopter_description' => 'required',
        ]);

        $validated['user_profile_id'] = $request->user()->userProfile->id;

        AdoptionApplication::create($validated);

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Your request has been submitted.',
                ],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(AdoptionApplication $adoptionApplication)
    {
        return $adoptionApplication;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdoptionApplication $adoptionApplication)
    {
        $validated = $request->validate([
            'contact' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'adopter_description' => 'required',
            'status' => 'required',
        ]);

        $adoptionApplication->update($validated);

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
    public function destroy(AdoptionApplication $adoptionApplication)
    {
        $adoptionApplication->delete();

        return [
            'message' => [
                    'status' => 'Application has been successfully deleted.',
                ],
        ];
    }
}
