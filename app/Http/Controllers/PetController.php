<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class PetController extends Controller
{
    const TYPE_DOG = 'Dog';
    const TYPE_CAT = 'Cat';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $request->user()->userProfile->pets;
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
            'health_status' => 'required',
            'description' => 'required',
            'images' => 'required|array', // Ensure images is an array
            'images.*' => 'required|image|max:3072|mimes:png,jpg,jpeg,webp',
        ]);

        $imagePaths = [];

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = Storage::disk('public')->put('images/petProfile', $image);
                array_push($imagePaths, $path);
            }
        }

        $validated['images'] = json_encode($imagePaths);
        $validated['images'] = stripslashes($validated['images']);

        $validated['user_profile_id'] = $request->user()->userProfile->id;

        Pet::create($validated);

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Pet profile created successfully.',
                ],
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return $pet;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:' . self::TYPE_DOG . ',' . self::TYPE_CAT,
            'breed' => 'required',
            'age' => 'required|numeric',
            'health_status' => 'required',
            'status' => 'required',
            'description' => 'required',
            'newImages' => 'nullable|array',
            'newImages.*' => 'nullable|image|max:3072|mimes:png,jpg,jpeg,webp'
        ];

        //Required images when 'images' and 'newImages' are both empty
        if(!$request->images && !$request->newImages){
            $rules['images'] = 'required|array';
        }else{
            $rules['images'] = 'nullable|array';
        }

        $validated = $request->validate($rules);

        $imagePaths = $validated['images'] ?? [];

        //Save new images
        if($request->hasFile('newImages')){
            foreach($request->file('newImages') as $image){
                $path = Storage::disk('public')->put('images/petProfile', $image);

                //Push new images paths 
                array_push($imagePaths, $path);
            }
        }

        //Get saved images
        $existingImages = json_decode($pet->images, true);

        //Delete images that are no longer in the new images
        foreach($existingImages as $existingImage){
            if(!in_array($existingImage, $imagePaths)){
                Storage::disk('public')->delete($existingImage);
            }
        }

        $validated['images'] = json_encode($imagePaths);
        $validated['images'] = stripslashes($validated['images']);

        $pet->name = $validated['name'];
        $pet->type = $validated['type'];
        $pet->breed = $validated['breed'];
        $pet->age = $validated['age'];
        $pet->health_status = $validated['health_status'];
        $pet->description = $validated['description'];
        $pet->status = $validated['status'];
        $pet->images = $validated['images'];
        $pet->save();

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Pet profile update successfully.',
                ],
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return [
            'message' => [
                    'status' => 'success',
                    'detail' => 'Pet profile deleted successfully.',
                ],
        ];
    }
}
