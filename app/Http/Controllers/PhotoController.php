<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Support\Facades\Gate;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Photo::class);

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
        $this->authorize('create', Photo::class);

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
        $this->authorize('create', Photo::class);

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
                'user_id' => auth()->id(),
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
                'message' => __('Your photo <b class="mr-1 ml-1">":name"</b> uploaded and saved.', ['name' => htmlentities($request->title)]),
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
        abort_unless(Gate::allows('view', $photo), 403);

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
        abort_unless(Gate::allows('update', $photo), 403);

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
        abort_unless(Gate::allows('update', $photo), 403);

        $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'location' => ['required', 'max:255'],
            'full_image' => ['mimes:png,jpg,jpeg', 'max:5120'],
        ]);

        $image = $request->file('full_image');
        $galleryId = intval($photo->gallery_id);

        if ($image === null) {
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
                'message' => __('Your photo <b class="mr-1 ml-1">":name"</b> successfully modified.', ['name' => htmlentities($request->title)]),
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
        abort_unless(Gate::allows('delete', $photo), 403);

        $oldTitle = htmlentities($photo->title);
        $galleryId = intval($photo->gallery_id);

        Photo::deleteImage(auth()->id(), $photo->gallery_id, $photo->full_image);
        Photo::deleteImage(auth()->id(), $photo->gallery_id, $photo->thumbnail_image);

        $photo->deleteOrFail();
        return redirect()->route('gallery.show', $galleryId)->with([
            'notification' => [
                'message' => __('<b class="mr-1">":name"</b> successfully deleted.', ['name' => $oldTitle]),
                'type'    => 'success'
            ]
        ]);
    }
}
