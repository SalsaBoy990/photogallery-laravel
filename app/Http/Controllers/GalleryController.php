<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::where('user_id', Auth::user()->id)->get();
        return view('gallery.index')->with([
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Gallery::class)],
            'description' => ['required', 'max:255', Rule::unique(Gallery::class)],
            'cover_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $coverImage = $request->file('cover_image');
        // TODO: More validation is needed !
        if (!$coverImage) {
            $coverImageName = 'placeholder.png';
        } else {
            $coverImageName = auth()->id() . '_' . time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(storage_path('app/user/' . $request->user->id . '/coverimages'), $coverImageName);
        }

        Gallery::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => intval($request->user->id),
            'cover_image' => htmlentities($coverImageName),
        ]);

        return redirect()->route('gallery.index')->with([
            'success' => 'Létrehoztad a "' . $request->name . '" nevű galériádat.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $photos = Photo::where('gallery_id', $gallery->id)->get();

        return view('gallery.show')->with([
            'gallery' => $gallery,
            'photos' => $photos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $Gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery.edit')->with([
            'gallery' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        dd($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        dd($gallery);
    }
}
