<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::query()->paginate(10);
        return ArtistResource::collection($artists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:artists,name'],
            'image_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);

        $artist = new Artist();
        $artist->name = $request->name;
        $artist->image_path = $request->image_path;
        $artist->save();
        $artists = $artist->refresh();
        return new ArtistResource($artists);
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return new ArtistResource($artist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => ['required', 'max:255',
                Rule::unique('artists', 'name')->ignore($artist)
            ],
            'image_path' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);

        $artist->name = $request->input('name');
        $artist->image_path = $request->input('image_path');
        $artist->save();
        $artists = $artist->refresh();

        return new ArtistResource($artists);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json(null, 204);
    }
}
