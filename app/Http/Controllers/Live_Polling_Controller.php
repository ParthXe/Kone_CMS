<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Live_Polling_Model;
use DB;

class Live_Polling_Controller extends Controller
{
    /**
     * Display a listing of the resource.
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
    public function create_live_polling()
    {
        //
          return view('live_polling.live_polling');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_live_polling(Request $request)
    {
        //
        $poll= new Live_Polling_Model();
        $poll->question= $request['question'];
        $poll->optionA= $request['optionA'];
        $poll->optionB= $request['optionB'];
        $poll->optionC= $request['optionC'];
        $poll->optionD= $request['optionD'];
        $poll->optionE= $request['optionE'];
        $poll->active = ($request['active'] == "on") ? 1 : 0;
        $poll_created_time=date("Y-m-d H:i:s");
        $poll_updated_time=date("Y-m-d H:i:s");
        // add other fields
        $poll->save();
        return redirect()->route('show_live_polling')->with('success','Live Poll Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_live_polling()
    {
        //
        $live_pollings = DB::select('select * from live_polling');
        return view('live_polling.live_polling_list',['live_pollings'=>$live_pollings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_live_polling($id)
    {
        //
        $live_pollings = DB::select('select * from live_polling where id = ?',[$id]);
        return view('live_polling.edit_live_polling',['live_pollings'=>$live_pollings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_live_polling(Request $request, $id)
    {
        //
        $question= $request['question'];
        $optionA= $request['optionA'];
        $optionB= $request['optionB'];
        $optionC= $request['optionC'];
        $optionD= $request['optionD'];
        $optionE= $request['optionE'];
        $active = ($request['active'] == "on") ? 1 : 0;
        $updated_time=date("Y-m-d H:i:s");
        DB::update('update live_polling set question=?,optionA=?,optionB=?,optionC=?,optionD=?,optionE=?,active=? where id = ?',[$question,$optionA,$optionB,$optionC,$optionD,$optionE,$active,$id]);
        return redirect()->route('show_live_polling')
                         ->with('success','Live Poll Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_live_polling($id)
    {
        //
          $live_pollings = DB::select('delete from live_polling where id= ?',[$id]);
          return redirect()->route('show_live_polling')
                           ->with('success','Live Poll Deleted Successfully');
    }

    public function live_pollings_report(Request $request){
      $live_pollings = DB::select('select * from live_polling');
      $polling_sessions = DB::select('select * from polling_session');
      return view('live_polling_report',['live_pollings'=>$live_pollings,'polling_sessions'=>$polling_sessions]);
    }

    public function live_polling_api(){
        return Live_Polling_Model::all();
    }
    public function live_polling_question_api($id){
         return Live_Polling_Model::findOrFail($id);
    }
}
