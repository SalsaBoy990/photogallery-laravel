<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index')->with([
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
        return view('tag.create');
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
            'name' => ['required', 'min:3', 'max:255', 'unique:tags'],
            'description' => ['required', 'min:10', 'max:255'],
        ]);

        $name = htmlspecialchars($request->name);
        $description = htmlspecialchars($request->description);

        Tag::create([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('tag.index')->with([
            'success' => '<b class="mr-1">' .  $name . '</b> címke sikeresen létrehozva.',
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
        return view('tag.show')->with([
            'tag' => $tag,
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
        return view('tag.edit')->with([
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
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'description' => ['required', 'min:10', 'unique:tags'],
        ]);

        $name = htmlspecialchars($request->name);
        $description = htmlspecialchars($request->description);

        $tag->update([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('tag.index')->with([
            'success' => '<b class="mr-1">' .  $name . '</b> címke sikeresen módosítva.',
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
        $oldName = $tag->name;
        $tag->deleteOrFail();
        return redirect()->route('tag.index')->with([
            'success' => '<b class="mr-1">' .  $oldName . '</b> címke sikeresen törölve.',
        ]);
    }
}
