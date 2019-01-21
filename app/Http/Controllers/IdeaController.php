<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!Gate::allows('isStudentsUnion', 'isCesi', 'isUser')){
        //     return view('home');
        // }
        $ideas = Idea::all();
        return view('ideas.index',compact('ideas',$ideas));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('isUser', 'isStudentsUnion', 'isCesi')){
            $ideas = Idea::all();
            return view('ideas.index',compact('ideas',$ideas));
        }
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);
        
        $idea = Idea::create(['title' => $request->title,'description' => $request->description]);
        return redirect('/ideas/'.$idea->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        return view('ideas.show',compact('idea',$idea));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        if(!Gate::allows('isStudentsUnion')){
            $ideas = Idea::all();
            return view('ideas.index',compact('ideas',$ideas));
        }
        return view('ideas.edit',compact('idea',$idea));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        //Validate
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);
        
        // créer un new activité.php et remplacer variable idea par la variable activité
        $idea->title = $request->title;
        $idea->description = $request->description;
        $idea->save();
        $request->session()->flash('message', 'Successfully modified the idea!');
        return redirect('ideas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Idea $idea)
    {
        if(!Gate::allows('isStudentsUnion')){
            $ideas = Idea::all();
            return view('ideas.index',compact('ideas',$ideas));
        }
        $idea->delete();
        $request->session()->flash('message', 'Successfully deleted the idea!');
        return redirect('ideas');
    }
}
