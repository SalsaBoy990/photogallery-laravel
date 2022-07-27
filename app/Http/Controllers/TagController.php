<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Gallery;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $callback = function ($query) {
            $query->where('user_id', Auth()->id());
        };
        $tags = Tag::whereRelation('user', 'id', Auth()->id())->with(['galleries' => $callback])->get();

        return view('app.tag.index')->with([
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:10', 'max:255'],
        ]);

        Tag::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth()->user()->id,
        ]);

        return redirect()->route('tag.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' . htmlentities($request->name) . '</b> címke sikeresen létrehozva.',
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $galleries = Tag::getTagWithItsGalleries($tag, 3);

        return view('app.tag.show')->with([
            'tag' => $tag,
            'galleries' => $galleries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('app.tag.edit')->with([
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10', 'unique:tags'],
        ]);

        $tag->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('app.tag.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  htmlentities($request->name) . '</b> címke sikeresen módosítva.',
                'type'    => 'success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $oldName = htmlentities($tag->name);
        $tag->deleteOrFail();
        return redirect()->route('tag.index')->with([
            'notification' => [
                'message' => '<b class="mr-1">' .  $oldName . '</b> címke sikeresen törölve.',
                'type'    => 'success'
            ]
        ]);
    }
}
