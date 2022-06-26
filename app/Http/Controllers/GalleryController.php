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
     * Show gallery list
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index')->with('galleries', $galleries);
    }

    /**
     * Shows gallery item
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Request $request)
    {
        $currentGallery = Gallery::findOrFail($request->gallery_id);
        $photos = Photo::where('gallery_id', $request->gallery_id)->get();

        return view('gallery.show')
            ->with('gallery', $currentGallery)
            ->with('photos', $photos);
    }


    /**
     * Creates new gallery
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('gallery.create');
    }


    /**
     * Saves new gallery
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255', Rule::unique(Gallery::class)],
            'description' => ['required', 'max:255', Rule::unique(Gallery::class)],
            'cover_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $coverImage = $request->file('cover_image');
        if (!$coverImage) {
            $coverImageName = 'placeholder.png';
        } else {
            $coverImageName = auth()->id() . '_' . time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(storage_path('app/user/' . $request->user->id . '/coverimages'), $coverImageName);
        }

        Gallery::create([
            'name' => htmlspecialchars($request->name),
            'description' => $request->description,
            'owner_id' => intval($request->user->id),
            'cover_image' => htmlspecialchars($coverImageName),
        ]);

        return redirect()->route('gallery.index')->with('success', 'Létrehoztad a "' . $request->name . '" nevű galériádat.');
    }


    /**
     * TODO: Updates gellery item
     * 
     * @param Request $request
     * 
     * @return [type]
     */
    public function update(Request $request)
    {
        dd($request);
    }


    /**
     * TODO: Deletes gallery item
     * 
     * @param Request $request
     * 
     * @return [type]
     */
    public function destroy(Request $request)
    {
        dd($request);
    }
}
