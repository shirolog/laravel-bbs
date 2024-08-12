<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $threads = Thread::with('user')
        ->withCount('replies')
        ->get();

        return view('index', compact('threads'));
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
        $request->validate([

            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $thread = new Thread;

        $thread -> user_id = Auth::user()->id;
        $thread -> title = $request->input('title');
        $thread -> content = $request->input('content');
        $thread->save();
        return redirect()->route('index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {  
        $thread->load('replies', 'user');
        return view('show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $thread->delete();

        return redirect()->route('index', compact('thread'));
    }
}
