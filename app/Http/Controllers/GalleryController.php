<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class GalleryController extends Controller
{

    /*public function __construct() {
        $this->middleware('auth')->except(['index']);
    }*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$galleries = Gallery::where('user_id', Auth::user()->id)->get();
        // $galleries = Gallery::where('user_id', Auth::user()->id)->paginate(3);
        $galleries = Gallery::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(3);

        if ($galleries->count() > 0) {
            return view('app.gallery.index')->with([
                'galleries' => $galleries
            ]);
        } else {
            return view('app.onboarding');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.gallery.create');
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
            $coverImageName = 'placeholder.jpg';
        } else {
            $coverImageName = auth()->id() . '_' . time() . '_' . $coverImage->getClientOriginalName();
            $coverImage->move(storage_path('app/user/' . $request->user->id . '/coverimages'), $coverImageName);
        }

        Gallery::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id(),
            'cover_image' => htmlentities($coverImageName),
        ]);

        return redirect()->route('gallery.index')->with([
            'success' => 'L??trehoztad a "' . htmlentities($request->name) . '" nev?? gal??ri??dat.'
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
        $allTags = Tag::all();
        $usedTags = $gallery->tags;
        $availableTags = $allTags->diff($usedTags);

        return view('app.gallery.show')->with([
            'gallery' => $gallery,
            'photos' => $photos,
            'availableTags' => $availableTags,
            'success' => Session::get('success'),
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
        return view('app.gallery.edit')->with([
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
