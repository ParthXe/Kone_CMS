<?php

namespace App\Http\Controllers;

use App\EventModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("home");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
          return view("events.events");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function save_event(Request $request)
    {
      $this->validate(request(),[
    //put fields to be validated here
    ]);

    $event= new EventModel();
    $event->event_name= $request['event_name'];
    $event->speaker_name= $request['speaker_name'];
    $event->event_description= $request['event_description'];
    $event->datetimepicker= $request['datetimepicker'];
    $event->active = ($request['active'] == "on") ? 1 : 0;
    // add other fields


    $event->save();

    return redirect()->route('events')->with('success','Event Upload Successfully');
    }

    public function show_event(){
      $events = DB::select('select * from events');
      return view('events.events_list',['events'=>$events]);
    }

    public function edit_event($id){
        $events = DB::select('select * from events where id = ?',[$id]);
        return view('events.edit_event',['events'=>$events]);
    }

    public function update_event(Request $request,$id){
      $event_name= $request['event_name'];
      $speaker_name= $request['speaker_name'];
      $event_description= $request['event_description'];
      $datetimepicker= $request['datetimepicker'];
      $active = ($request['active'] == "on") ? 1 : 0;

      DB::update('update events set id = ?,event_name=?,speaker_name=?,datetimepicker=?,	active=? where id = ?',[$id,$event_name,$speaker_name,$event_description,$datetimepicker,$active]);

      return redirect()->route('events')
                       ->with('success','Event Updated Successfully');
    }
}
