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
            'full_image' => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'gallery_id' => ['required'],
        ]);

        $image = $request->file('full_image');
        $isValid = $image && $image->isValid();
        $galleryId = intval($request->gallery_id);

        if ($isValid) {
            $userFolder = 'app/user/' . auth()->id();
            $photosFolder = $userFolder . '/photos';
            $galleryFolder = $photosFolder . '/' . $galleryId;
            $imageSettings = Photo::generateImagePaths($image, auth()->id(), $galleryFolder);

            Photo::createFoldersIfNotExist($userFolder, $photosFolder, $galleryFolder);
            Photo::saveImage($image, $imageSettings['imagePath'], $imageSettings['thumbnailImagePath']);

            Photo::create([
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'full_image' => $imageSettings['imageFileName'],
                'thumbnail_image' => $imageSettings['thumbnailImageFileName'],
                'gallery_id' => $galleryId,
            ]);
        }

        return redirect()->route('gallery.show', $galleryId)->with([
            'notification' => [
                'message' => 'Hozzáadtad a <b>"' . htmlentities($request->title) . '"</b> nevű képedet.',
                'type'    => 'success'
            ]
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
        $gallery = Gallery::where('id', intval($photo->gallery_id))->firstOrFail();

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
            'full_image' => ['mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $image = $request->file('full_image');
        $galleryId = intval($photo->gallery_id);

        if ($image === null || !$image->isValid()) {
            $photo->update([
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
            ]);
        } else {
            $isValid = $image && $image->isValid();

            if ($isValid) {
                $userFolder = 'app/user/' . auth()->id();
                $photosFolder = $userFolder . '/photos';
                $galleryFolder = $photosFolder . '/' . $galleryId;
                $imageSettings = Photo::generateImagePaths($image, auth()->id(), $galleryFolder);


                if (Photo::checkIfImageExists(auth()->id(), $galleryId, $photo->full_image)) {
                    Photo::deleteImage(auth()->id(), $galleryId, $photo->full_image);
                }
                if (Photo::checkIfImageExists(auth()->id(), $galleryId, $photo->thumbnail_image)) {
                    Photo::deleteImage(auth()->id(), $galleryId, $photo->thumbnail_image);
                }

                Photo::createFoldersIfNotExist($userFolder, $photosFolder, $galleryFolder);
                Photo::saveImage($image, $imageSettings['imagePath'], $imageSettings['thumbnailImagePath']);

                $photo->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'location' => $request->location,
                    'full_image' => $imageSettings['imageFileName'],
                    'thumbnail_image' => $imageSettings['thumbnailImageFileName'],
                ]);
            }
        }

        return redirect()->route('gallery.show', $galleryId)->with([
            'notification' => [
                'message' => 'Frissítetted a <b>"' . htmlentities($request->title) . '"</b> nevű képed adatait.',
                'type'    => 'success'
            ]
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
        $oldTitle = htmlentities($photo->title);
        $galleryId = intval($photo->gallery_id);

        Photo::deleteImage(auth()->id(), $photo->gallery_id, $photo->full_image);
        Photo::deleteImage(auth()->id(), $photo->gallery_id, $photo->thumbnail_image);

        $photo->deleteOrFail();
        return redirect()->route('gallery.show', $galleryId)->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  $oldTitle . '</b> sikeresen törölve.',
                'type'    => 'success'
            ]
        ]);
    }
}
