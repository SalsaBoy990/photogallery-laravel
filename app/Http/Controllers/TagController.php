<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTagRequest;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);

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
        $this->authorize('create', Tag::class);

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
        $this->authorize('create', Tag::class);

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
                'message' => __('The tag <b class="mr-1 ml-1">":name"</b> successfully created.', ['name' => htmlentities($request->name)]),
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
        abort_unless(Gate::allows('view', $tag), 403);

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
        abort_unless(Gate::allows('update', $tag), 403);

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
        abort_unless(Gate::allows('update', $tag), 403);

        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'max:255'],
        ]);

        $tag->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('tag.index')->with([
            'notification' => [
                'message' => __('The tag <b class="mr-1 ml-1">":name"</b> successfully modified.', ['name' => htmlentities($request->name)]),
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
        abort_unless(Gate::allows('delete', $tag), 403);

        $oldName = htmlentities($tag->name);
        $tag->deleteOrFail();
        return redirect()->route('tag.index')->with([
            'notification' => [
                'message' => __('The tag <b class="mr-1 ml-1">":name"</b> successfully deleted.', ['name' => $oldName]),
                'type'    => 'success'
            ]
        ]);
    }
}
