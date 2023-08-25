<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        $replies = Reply::where('parent_id', $post->id)->orderBy('created_at', 'asc')->get();
        $replies_count = $replies->count();
        return view('replies.reply', compact('post', 'replies', 'replies_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Reply::create($request->post());

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
    public function like(Reply $reply)
    {

        if ($reply->liked()) {
            $reply->unlike();
        } else {
            $reply->like();
        }
        return redirect()->back();
    }
}