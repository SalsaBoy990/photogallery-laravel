<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Photo;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'cover_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5120'],
        ]);

        $coverImage = $request->file('cover_image');
        $isValid = $coverImage && $request->file('cover_image')->isValid();

        if ($isValid) {
            $currentDate = date("Ym");
            $userFolder = 'app/user/' . auth()->id();
            $coverImagesFolder = $userFolder . '/coverimages';
            $coverImagesYearMonthFolder = $coverImagesFolder . '/' . $currentDate;
            
            $imageSettings = Gallery::generateCoverImagePaths($isValid, $coverImage, auth()->id(), $coverImagesYearMonthFolder);
            
            Gallery::createFoldersIfNotExist($userFolder, $coverImagesFolder, $coverImagesYearMonthFolder);
            Gallery::saveImage($coverImage, $imageSettings['imagePath'], $imageSettings['thumbnailImagePath']);
            
            Gallery::create([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'cover_image' => $imageSettings['imageFileName'],
                'thumbnail_image' => $imageSettings['thumbnailImageFileName'],
            ]);
        } else {
            $placeholderImageName = 'placeholder.jpg';

            Gallery::create([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'cover_image' => $placeholderImageName,
                'thumbnail_image' => $placeholderImageName,
            ]);
        }

        return redirect()->route('gallery.index')->with([
            'notification' => [
                'message' => 'Létrehoztad a <b>"' . htmlentities($request->name) . '"</b> nevű galériádat.',
                'type'    => 'success'
            ]
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
        $allTags = Tag::where('user_id', $gallery->user_id)->get();
        $usedTags = $gallery->tags;
        $availableTags = $allTags->diff($usedTags);

        return view('app.gallery.show')->with([
            'gallery' => $gallery,
            'photos' => $photos,
            'availableTags' => $availableTags,
            'notification' => Session::get('notification'),
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
        $allTags = Tag::all();
        $usedTags = $gallery->tags;
        $availableTags = $allTags->diff($usedTags);
        return view('app.gallery.edit')->with([
            'availableTags' => $availableTags,
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
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'cover_image' => ['nullable', 'mimes:png,jpg,jpeg', 'max:5120'],
        ]);

        $coverImage = $request->file('cover_image');

        if ($coverImage === null) {
            $gallery->update([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
            ]);
        } else {
            $isValid = $coverImage && $request->file('cover_image')->isValid();
            $currentDate = date("Ym");
            $userFolder = 'app/user/' . auth()->id();
            $coverImagesFolder = $userFolder . '/coverimages';
            $coverImagesYearMonthFolder = $coverImagesFolder . '/' . $currentDate;

            $imageSettings = Gallery::generateCoverImagePaths($isValid, $coverImage, auth()->id(), $coverImagesYearMonthFolder);

            if (Gallery::checkIfCoverImageExists(auth()->id(), $gallery->cover_image)) {
                Gallery::deleteCoverImage(auth()->id(), $gallery->cover_image);
            }
            if (Gallery::checkIfCoverImageExists(auth()->id(), $gallery->thumbnail_image)) {
                Gallery::deleteCoverImage(auth()->id(), $gallery->thumbnail_image);
            }

            Gallery::createFoldersIfNotExist($userFolder, $coverImagesFolder, $coverImagesYearMonthFolder);
            Gallery::saveImage($coverImage, $imageSettings['imagePath'], $imageSettings['thumbnailImagePath']);

            $gallery->update([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'cover_image' => $currentDate . '/' . $imageSettings['imageFileName'],
                'thumbnail_image' => $currentDate . '/' . $imageSettings['thumbnailImageFileName'],
            ]);
        }

        return redirect()->route('gallery.show', $gallery->id)->with([
            'notification' => [
                'message' => 'Frissítetted a <b>"' . htmlentities($request->name) . '"</b> nevű galériádat.',
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $oldName = htmlentities($gallery->name);

        Gallery::deleteCoverImage(auth()->id(), $gallery->cover_image);
        Gallery::deleteCoverImage(auth()->id(), $gallery->thumbnail_image);

        $gallery->deleteOrFail();
        return redirect()->route('gallery.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  $oldName . '</b> sikeresen törölve.',
                'type'    => 'success'
            ]
        ]);
    }
}
