<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Gallery;
use Illuminate\Support\Facades\Gate;

class GalleryTagController extends Controller
{

    public function attachTag(Gallery $gallery, Tag $tag)
    {
        if (Gate::denies('connect_tag_to_gallery', $gallery)) {
            abort(403, "Action forbidden");
        }

        $gallery->tags()->attach($tag->id);

        return back()->with([
            'notification' => [
                'message' => '<b class="mr-1">"' . htmlentities($tag->name)  . '"</b> címke hozzáadva a galériához.',
                'type'    => 'success',
            ]
        ]);
    }

    public function detachTag(Gallery $gallery, Tag $tag)
    {
        if (Gate::denies('connect_tag_to_gallery', $gallery)) {
            abort(403, "Action forbidden");
        }

        $gallery->tags()->detach($tag->id);

        return back()->with([
            'notification' => [
                'message' => '<b class="mr-1">"' . htmlentities($tag->name)  . '"</b> címke eltávolítva.',
                'type'    => 'success',
            ]

        ]);
    }
}
