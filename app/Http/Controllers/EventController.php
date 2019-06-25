<?php
namespace App\Http\Controllers;

use App\EventModel as Events;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PDF;

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
          $event_session_time=DB::select('select * from events_session_time');
          return view("events.events",['event_session_time'=>$event_session_time]);
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

    //print_r($request);
    $event= new EventModel();
    $event->event_name= $request['event_name'];
    $event->speaker_name= $request['speaker_name'];
    $event->event_description= $request['event_description'];
    $event->active = ($request['active'] == "on") ? 1 : 0;
    $event_sessions_count=$request['session_count'];
    $event_created_time=date("Y-m-d H:i:s");
    $event_updated_time=date("Y-m-d H:i:s");
    // add other fields
    $event->save();
    $event_id=$event->id;
    $event_sessions_arr=array();

    for($i=1;$i<=$event_sessions_count;$i++){
      $event_session_from=$_POST['event_session'.$i.'_from'];
      $event_session_to=$_POST['event_session'.$i.'_to'];
      $event_session_time=$event_session_from.'-'.$event_session_to;
      array_push($event_sessions_arr,$event_session_time);
    }
    $event_sessions = implode(",", $event_sessions_arr);

    DB::insert('insert into event_sessions (event_id, event_sessions_time,created_at,updated_at) values (?,?,?,?)', [$event_id,$event_sessions,$event_created_time,$event_updated_time]);
    return redirect()->route('show_event')->with('success','Event Added Successfully');
    }

    public function update_event(Request $request,$id){
      $event_name= $request['event_name'];
      $speaker_name= $request['speaker_name'];
      $event_description= $request['event_description'];
      $active = ($request['active'] == "on") ? 1 : 0;
      $session_count=$request['session_count'];
      $event_created_time=date("Y-m-d H:i:s");
      $event_updated_time=date("Y-m-d H:i:s");
      $event_id=$id;
      $event_sessions_arr=array();

      DB::update('update events set event_name=?,speaker_name=?,event_description=?,active=? where id = ?',[$event_name,$speaker_name,$event_description,$active,$id]);

      for($i=1;$i<=$session_count;$i++){
        $event_session_from=$_POST['event_session'.$i.'_from'];
        $event_session_to=$_POST['event_session'.$i.'_to'];
        $event_session_time=$event_session_from.'-'.$event_session_to;
        array_push($event_sessions_arr,$event_session_time);
      }
      $event_sessions = implode(",", $event_sessions_arr);
      //echo $event_sessions;
      echo DB::update('update event_sessions set event_sessions_time=?,updated_at=? where event_id = ?',[$event_sessions,$event_updated_time,$event_id]);

      return redirect()->route('show_event')
                       ->with('success','Event Updated Successfully');
    }

    public function show_event(){
      $events = DB::select('select * from events');
      $event_sessions = DB::select('select * from event_sessions');
      return view('events.events_list',['events'=>$events,'event_sessions'=>$event_sessions]);

    }

    public function edit_event($id){
        $events = DB::select('select * from events where id = ?',[$id]);
        $event_session = DB::select('select * from event_sessions where event_id = ?',[$id]);
        $event_session_time=DB::select('select * from events_session_time');
        return view('events.edit_event',['events'=>$events,'event_session'=>$event_session,'event_session_time'=>$event_session_time]);
    }

    public function delete_event($id){
      $events = DB::select('delete from events where id= ?',[$id]);
      $events = DB::select('delete from event_sessions where event_id= ?',[$id]);
      return redirect()->route('show_event')
                       ->with('success','Event Deleted Successfully');
    }

     public function events_report(Request $request){
       $events = DB::select('select * from events');
       $event_sessions = DB::select('select * from event_sessions');
       view()->share('events',$events);
       view()->share('event_sessions',$event_sessions);
       return view('events_report');
     }
}
