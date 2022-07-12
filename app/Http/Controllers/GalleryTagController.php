<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Gallery;

class GalleryTagController extends Controller
{
    
    public function attachTag(Gallery $gallery, Tag $tag) {
        $gallery->tags()->attach($tag->id);

        return back()->with([
            'success' => '<b class="mr-1">"' . $tag->name  . '"</b> címke hozzáadva a galériához.',
        ]);

    }

    public function detachTag(Gallery $gallery, Tag $tag)
    {
        $gallery->tags()->detach($tag->id);

        return back()->with([
            'success' => '<b class="mr-1">"' . $tag->name  . '"</b> címke törölve a galériától.',
        ]);
    }
}
