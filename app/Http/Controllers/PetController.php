<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    const TYPE_DOG = 'dog';
    const TYPE_CAT = 'cat';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Pet::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required|in:' . self::TYPE_DOG . ',' . self::TYPE_CAT,
            'breed' => 'required',
            'age' => 'required|numeric',
            'health_status' => 'required|numeric',
            'description' => 'required|numeric',
            'images.*' => 'required|image|max:3072|mimes:png,jpg,jpeg,webp',
        ]);

        $imagePaths = [];

        if($request->hasFile('images')){
            foreach ($request->file('images') as $image) {
                $path = Storage::disk('public')->put('images/petProfile', $image);
                array_push($imagePaths, $path);
            }
        }

        $validated['images'] = json_encode($imagePaths);

        Pet::create($validated);

        return response()->json([
            'message' => [
                    'status' => 'success',
                    'detail' => 'Pet profile created successfully.',
                ],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required|in:' . self::TYPE_DOG . ',' . self::TYPE_CAT,
            'breed' => 'required',
            'age' => 'required|numeric',
            'health_status' => 'required|numeric',
            'description' => 'required',
            'images.*' => 'required|image|max:3072|mimes:png,jpg,jpeg,webp',
        ]);
    
        $existingImages = json_decode($pet->images, true);
        $newImages = $request->file('images');
        $imagePaths = [];
    
        // Check for new images and save them
        if($newImages){
            foreach($newImages as $image){
                $path = Storage::disk('public')->put('images/petProfile', $image);
                array_push($imagePaths, $path);
            }
        }
    
        // Merge existing images that are still in the request
        foreach($existingImages as $existingImage){
            if(!in_array($existingImage, $imagePaths)){
                array_push($imagePaths, $existingImage);
            }
        }
    
        // Delete images that are no longer in the request
        foreach($existingImages as $existingImage){
            if(!in_array($existingImage, $imagePaths)){
                Storage::disk('public')->delete($existingImage);
            }
        }
    
        $validated['images'] = json_encode($imagePaths);
    
        $pet->update($validated);
    
        return response()->json([
            'message' => [
                'status' => 'success',
                'detail' => 'Pet profile updated successfully.',
            ],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response()->json([
            'message' => [
                    'status' => 'success',
                    'detail' => 'Pet profile deleted successfully.',
                ],
        ]);
    }
}
