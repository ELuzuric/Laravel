<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use File;
use Illuminate\Support\Facades\Input;
use DB;
use App\Notifications\IdeaCheck;
use App\Http\Controllers\IdeaController;
use Notification;
use App\Notifications\Report;
use Carbon\Carbon;
use ZipArchive;
use App\ImageComment;



class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    // public function RedirectForDate()
    // {

    //     $now = new Carbon();
    //     $date = $request->date;

    //     $startTime = new Carbon($date);
    //     $startTime->format('Y-m-d');
    //     $startTime->isPast();


    //     if ($startTime ==  true) {

    //         return redirect('/pastactivities/'.$activity->id)->with($activities);
    //     }

    // }

    public function index()
    
    {
        $activities = Activity::all();
        $now = Carbon::Today();
        $test = Activity::select('date')->get();
        
        foreach ($test as $key => $value) {


            $lul = $test[$key]->date;

            if ($lul < $now) {

            }else {

            }

            
        }

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

        $now = new Carbon();
        $date = $request->date;

        $startTime = new Carbon($date);
        $startTime->format('Y-m-d');
        $startTime->isPast();
        dd($startTime->isPast());

        if ($startTime ==  true) {
            return redirect('/pastactivities/'.$activity->id)->back()->with($activities);
        }
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




        
        // $date = format('Y/m/d');
        // dd($now);


         // $date->isPast();
         // dd($date);

        // if ($now >= $date) {

        // }

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
        $info_activity = $activity;
        $id_activity = $activity->id;
        $imagecomment = DB::table('image_comments')->where('activity_id',$id_activity)->get();
        return view('activities.show',compact('info_activity','imagecomment'));
     

        
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
        $activity->date = $request->date->format('d/m/Y');
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


    public function cesi(){

        $activities = Activity::all();   
        $report = \App\Activity::first();
        $cesi = \App\User::select('email')->where('permission', 1)->get();

        Notification::route('mail', $cesi)->notify(new Report($report));

        return view('activities.index',compact('activities'));

    }



    // public function RedirectForDate(Request $request, Activity $activity)
    // {
    //     $now = new Carbon();
    //     $date = $request->date;
    //     dd($date);

    //     $startTime = new Carbon($date);
    //     $startTime->format('Y-m-d');
    //     $startTime->isPast();

    //     if ($startTime ==  true) {

    //     return redirect('/pastactivities/'.$activity->id)->with($activities);
    //     }
    // }
    public function download_picture($id){

        $table = DB::table('activities')->where('id', $id)->get();


        $zip = new ZipArchive();
        $zip->open('images.zip', ZipArchive::CREATE);
        foreach ($table as $el) {
            $zip->addFile('images/'.$el->URLimage);
        }
        $zip->close();
        header('Content-disposition: attachment; filename= images.zip'); 
        header('Content-Type: application/force-download'); 
        header('Content-Transfer-Encoding: fichier');
        header('Content-Length: '.filesize('images.zip')); 
        header('Pragma: no-cache'); 
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0'); 
        header('Expires: 0'); 
        readfile('images.zip');
    }


    public function ImageStore(Request $request, $id)
    {
        $id_activity = $id;
        $user = new file;
        $Act = DB::table('activities')->where('id',$id_activity)->get();


        if(Input::hasFile('file')){

            $file = Input::file('file');
            $file->move(public_path(). '/images', $file->getClientOriginalName());
            $request->file = $file->getClientOriginalName();
            $id = DB::getPdo()->lastInsertId();
        }
        
        $imagecomment = ImageComment::create(['id' => $request->id, 'URLimage' => $request->file, 'activity_id' => $id_activity]);


        $imagecomment = DB::table('image_comments')->where('activity_id',$id_activity)->get();
        
        return redirect('/activities/'.$id_activity);
    }


}
