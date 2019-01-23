<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use File;
use Illuminate\Support\Facades\Input;
use DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view('activities.index',compact('activities',$activities));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('isStudentsUnion')){
            $activities = Activity::all();
            return view('activities.index',compact('activities',$activities));
        }
        return view('activities.create');
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
            'date' => 'required',
            'condition' => 'required',
            'recurrence' => 'required',
            'time',
        ]);
        $user = new file;

        if(Input::hasFile('file')){

            $file = Input::file('file');
            $file->move(public_path(). '/images', $file->getClientOriginalName());
               $request->file = $file->getClientOriginalName();
                $id = DB::getPdo()->lastInsertId();
            }
        
        $activity = Activity::create(['title' => $request->title,'description' => $request->description, 'date' => $request->date, 'condition' => $request->condition, 'recurrence' => $request->recurrence, 'time' => $request->time, 'URLimage' => $request->file]);
       
        return redirect('/activities/'.$activity->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activities.show',compact('activity',$activity));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        if(!Gate::allows('isStudentsUnion')){
            $activities = Activity::all();
            return view('activities.index',compact('activities',$activities));
        }
        return view('activities.edit',compact('activity',$activity));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //Validate
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'date' => 'required',
            'condition' => 'required',
            'recurrence' => 'required',
            'time',
        ]);
        
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->date = $request->date;
        $activity->condition = $request->condition;
        $activity->recurrence = $request->recurrence;
        $activity->time = $request->time;
        $activity->save();
        $request->session()->flash('message', 'Successfully modified the activity!');
        return redirect('activities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        if(!Gate::allows('isStudentsUnion')){
            $activities = Activity::all();
            return view('activities.index',compact('activities',$activities));
        }
        $activity->delete();
        $request->session()->flash('message', 'Successfully deleted the activity!');
        return redirect('activities');
    }
}
