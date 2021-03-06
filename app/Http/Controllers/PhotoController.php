<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('app.photo.index')->with([
            'photos' => $photos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gallery $gallery)
    {
        return view('app.photo.create')->with([
            'gallery' => $gallery
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'gallery_id' => ['required'],
        ]);


        $image = $request->file('image');
        $imageName = auth()->id() . '_' . time() . '_' .  $image->getClientOriginalName();
        $image->move(storage_path('app/user/' . $request->user->id . '/photos'), $imageName);

        Photo::create([
            'title' => htmlspecialchars($request->title),
            'description' => htmlspecialchars($request->description),
            'location' => htmlspecialchars($request->location),
            'image' => htmlspecialchars($imageName),
            'gallery_id' => intval($request->gallery_id),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('gallery.show', intval($request->gallery_id))->with([
            'success' => 'Hozzáadtad a "' . htmlentities($request->title) . '" nevű képedet.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        $gallery = Gallery::where('id', intval($photo->gallery_id))->first();

        return view('app.photo.show')->with([
            'photo' => $photo,
            'gallery' => $gallery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('app.photo.edit')->with([
            'photo' => $photo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'gallery_id' => ['required'],
        ]);

        $photo->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'gallery_id' => intval($request->gallery_id),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('gallery.show', intval($request->gallery_id))->with([
            'success' => 'Frissítetted a "' . htmlentities($request->title) . '" nevű képed adatait.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        dd($photo);
    }
}
