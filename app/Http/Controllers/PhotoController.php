<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function show(Request $request)
    {
        $photo = Photo::findOrFail(intval($request->photo_id));
        $gallery = Gallery::where('id', intval($photo->gallery_id))->first();

        return view('photo.show')
            ->with('photo', $photo)
            ->with('gallery', $gallery);
    }

    public function create(int $gallery_id)
    {
        $gallery = Gallery::findOrFail($gallery_id);
        return view('photo.create')->with('gallery', $gallery);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'image' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'owner_id' => ['required'],
            'gallery_id' => ['required'],
        ]); // triggers exception


        $image = $request->file('image');
        $imageName = auth()->id() . '_' . time() . '_' .  $image->getClientOriginalName();
        $image->move(storage_path('app/user/' . $request->user->id . '/photos'), $imageName);

        Photo::create([
            'title' => htmlspecialchars($request->title),
            'description' => htmlspecialchars($request->description),
            'location' => htmlspecialchars($request->location),
            'image' => htmlspecialchars($imageName),
            'gallery_id' => intval($request->gallery_id),
            'owner_id' => intval($request->owner_id),
        ]);

        return redirect()->route('gallery.show', $request->gallery_id)->with('success', 'Hozzáadtad a "' . $request->title . '" nevű képedet.');
    }

    public function update(Request $request)
    {
        $photo = Photo::findOrFail(intval($request->photo_id))->first();
        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'owner_id' => ['required'],
            'gallery_id' => ['required'],
        ]); // triggers exception

        $photo->update(
            [
                'title' => htmlspecialchars($request->title),
                'description' => htmlspecialchars($request->description),
                'location' => htmlspecialchars($request->location),
                'gallery_id' => intval($request->gallery_id),
                'owner_id' => intval($request->owner_id),
            ]
        );


        return redirect()->route('gallery.show', $request->gallery_id)->with('success', 'Frissítetted a "' . $request->title . '" nevű képed adatait.');
    }

    public function destroy($id)
    {
        dd($id);
    }
}
