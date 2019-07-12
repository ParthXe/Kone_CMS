<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaModel;
use DB;

class AgendaController extends Controller
{
    //
    /* Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
     public function index()
     {
         //
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_agenda()
    {
        //
          return view('agenda.agenda');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_agenda(Request $request)
    {
        //
        $agenda= new AgendaModel();
        $agenda->session_id= $request['session_id'];
        $start_time= $request['start_time'];
        $end_time= $request['end_time'];
        $agenda->time= $start_time.'hrs - '.$end_time.' hrs';
        $agenda->topic= $request['topic'];
        $agenda->info= $request['info'];
        $agenda->owner= $request['owner'];
        $agenda->active = ($request['active'] == "on") ? 1 : 0;
        $agenda_created_time=date("Y-m-d H:i:s");
        $agenda_updated_time=date("Y-m-d H:i:s");
        // add other fields
        $agenda->save();
        return redirect()->route('show_agenda')->with('success','Agenda Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_agenda()
    {
        //
        $agendas = DB::select('select * from agenda');
        //print_r($agendas);
        return view('agenda.agenda_list',['agendas'=>$agendas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_agenda($id)
    {
        //
        $agendas = DB::select('select * from agenda where id = ?',[$id]);
        return view('agenda.edit_agenda',['agendas'=>$agendas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_agenda(Request $request, $id)
    {
        //

        $session_id= $request['session_id'];
        $start_time= $request['start_time'];
        $end_time= $request['end_time'];
        $time=$start_time.' hrs - '.$end_time.' hrs';
        $topic= $request['topic'];
        $info= $request['info'];
        $owner= $request['owner'];
        $active = ($request['active'] == "on") ? 1 : 0;
        $updated_time=date("Y-m-d H:i:s");
        DB::update('update agenda set session_id=?,time=?,topic=?,info=?,owner=?,active=? where id = ?',[$session_id,$time,$topic,$info,$owner,$active,$id]);
        return redirect()->route('show_agenda')
                         ->with('success','Agenda Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_agenda($id)
    {
        //
          $agendas = DB::select('delete from agenda where id= ?',[$id]);
          return redirect()->route('show_agenda')
                           ->with('success','Agenda Deleted Successfully');
    }

    public function agenda_api(){
      $agendas = DB::select('SELECT * FROM agenda ORDER BY agenda.time ASC');
    //  $response = array($agendas);
      return response()->json($agendas);
    }

    public function agenda_session_api($id){
     if($id=='1')
     {
       $response = DB::select('SELECT * FROM agenda WHERE session_id=? ORDER BY agenda.time ASC',[$id]);
       //$response = array($attendee_list);
       return response()->json($response);
       //echo $id;
     }
     else if($id=='2')
     {
       $response = DB::select('SELECT * FROM agenda WHERE session_id=? ORDER BY agenda.time ASC',[$id]);
       //$response = array($attendee_list);
       return response()->json($response);
     }
     else if($id=='0')
     {
       $response = DB::select('SELECT * FROM agenda ORDER BY agenda.time ASC');
       //$response = array($attendee_list);
       return response()->json($response);
     }
     else
     {
           return false;
     }
   }

}
