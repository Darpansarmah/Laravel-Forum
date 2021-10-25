<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discussion;
use App\Reply;
use App\Http\Requests\CreateDiscussionsRequest;
use Illuminate\Support\Str;

class DiscussionController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'verified'])->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discussions = Discussion::filterByChannels()->paginate(5);
        return view('discussions.index', ['discussions'=>$discussions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('discussions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionsRequest $request)
    {
        //
        auth()->user()->discussions()->create([
            'title'=>$request->title,
            'content'=>$request->content,
            'slug'=>Str::slug($request->title, '-'),
            'channel_id'=>$request->channel
        ]);

        session()->flash('success', 'Discussion Posted Successfully');
        return redirect()->route('discussions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        //
        return view('discussions.show', ['discussion'=>$discussion]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);
        session()->flash('success', 'Marked as Best Reply');
        return back();
    }
}
