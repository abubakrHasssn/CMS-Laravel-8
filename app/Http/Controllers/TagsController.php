<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTagRequest $request
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        session()->flash('success','Tag created successfully.');
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return void
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        session()->flash('success','Tag updated successfully.');
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return void
     */
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0){
            session()->flash('warning','This Tag Can not be deleted, its associated with some posts.');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success','Tag deleted successfully.');
        return redirect(route('tags.index'));
    }
}
