<?php

namespace App\Http\Controllers;

use App\Participate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;

class ParticipateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('isStudentsUnion')){
            $participates = Participate::all();
            return view('home');
        }
        $participates = Participate::all();
        return view('participates.index',compact('participates',$participates));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('isUser')){
            $participates = Participate::all();
            return view('home');
        }
        return view('participates.create');
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
            'firstName' => 'required',
            'lastName' => 'required',
        ]);
        
        $participate = Participate::create(['firstName' => $request->firstName,'lastName' => $request->lastName]);
        return redirect('/activities');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function show(Participate $participate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function edit(Participate $participate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participate $participate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participate  $participate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Participate $participate)
    {
        if(!Gate::allows('isStudentsUnion')){
            $participates = Participate::all();
            return view('home');
        }
        $participate->delete();
        $request->session()->flash('message', 'Successfully removed the student from this activity!');
        return redirect('participates');
    }
}
