<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedbackModel;
use DB;

class FeedbackController extends Controller
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
    public function create_feedback()
    {
        //
          return view('feedback.feedback');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_feedback(Request $request)
    {
        //
        $feedback= new FeedbackModel();
        $feedback->question= $request['question'];
        $feedback->optionA= $request['optionA'];
        $feedback->optionB= $request['optionB'];
        $feedback->optionC= $request['optionC'];
        $feedback->optionD= $request['optionD'];
        $feedback->active = ($request['active'] == "on") ? 1 : 0;
        $feedback_created_time=date("Y-m-d H:i:s");
        $feedback_updated_time=date("Y-m-d H:i:s");
        // add other fields
        $feedback->save();
        return redirect()->route('show_feedback')->with('success','Feedback Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_feedback()
    {
        //
        $feedbacks = DB::select('select * from feedback');
        return view('feedback.feedback_list',['feedbacks'=>$feedbacks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_feedback($id)
    {
        //
        $feedbacks = DB::select('select * from feedback where id = ?',[$id]);
        return view('feedback.edit_feedback',['feedbacks'=>$feedbacks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_feedback(Request $request, $id)
    {
        //
        $question= $request['question'];
        $optionA= $request['optionA'];
        $optionB= $request['optionB'];
        $optionC= $request['optionC'];
        $optionD= $request['optionD'];
        $active = ($request['active'] == "on") ? 1 : 0;
        $updated_time=date("Y-m-d H:i:s");
        DB::update('update feedback set question=?,optionA=?,optionB=?,optionC=?,optionD=?,active=? where id = ?',[$question,$optionA,$optionB,$optionC,$optionD,$active,$id]);
        return redirect()->route('show_feedback')
                         ->with('success','Feedback Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_feedback($id)
    {
        //
          $feedbacks = DB::select('delete from feedback where id= ?',[$id]);
          return redirect()->route('show_feedback')
                           ->with('success','Feedback Deleted Successfully');
    }

    public function feedbacks_report(Request $request){
      $feedbacks = DB::select('select * from feedback');
      $feedback_sessions = DB::select('select * from feedback_sessions');
      return view('feedback_report',['feedbacks'=>$feedbacks,'feedback_sessions'=>$feedback_sessions]);
    }

    public function show_attendee_list(){
      $attendee_list = DB::select('select * from user_details');
      return view('attendee_list',['attendee_list'=>$attendee_list]);
    }

    public function filter_attendee_list(Request $request){
      //echo $request['message'];
    	if($request['message']=='9')
    	{
    		$attendee_list = DB::select('select * from user_details');
        		 	$response = array(
              'attendee_list' => $attendee_list,
          );
    				return response()->json($response);
    	}
      else if($request['message']=='1')
    	{
    		$attendee_list = DB::select('select * from user_details where session_id=1');
        		 	$response = array(
              'attendee_list' => $attendee_list,
          );
    				return response()->json($response);
    	}
      else if($request['message']=='2')
    	{
    		$attendee_list = DB::select('select * from user_details where session_id=2');
        		 	$response = array(
              'attendee_list' => $attendee_list,
          );
    				return response()->json($response);
    	}
      else if($request['message']=='0')
      {
        $attendee_list = DB::select('select * from user_details where session_id=0');
              $response = array(
              'attendee_list' => $attendee_list,
          );
            return response()->json($response);
      }
    	else
    	{
    				return false;
    	}
    }
    public function feedback_api(){
        return FeedbackModel::all();
    }
    public function feedback_question_api($id){
         return FeedbackModel::findOrFail($id);
    }

    public function attendee_api(){
      $attendee_list = DB::select('select id,name,email,mobile,profile_pic,session_id from user_details');
        $response = array ($attendee_list);
          return response()->json($response);
    }

    public function attendee_session_api($id){
      if($id=='9')
      {
        $attendee_list = DB::select('select id,name,email,mobile,profile_pic,session_id from user_details');
              $response = array($attendee_list);
            return response()->json($response);
      }
      else if($id=='1')
      {
        $attendee_list = DB::select('select id,name,email,mobile,profile_pic,session_id from user_details where session_id=1');
              $response = array($attendee_list);
            return response()->json($response);
      }
      else if($id=='2')
      {
        $attendee_list = DB::select('select id,name,email,mobile,profile_pic,session_id from user_details where session_id=2');
              $response = array($attendee_list);
            return response()->json($response);
      }
      else if($id=='0')
      {
        $attendee_list = DB::select('select id,name,email,mobile,profile_pic,session_id from user_details where session_id=0');
              $response = array($attendee_list);
            return response()->json($response);
      }
      else
      {
            return false;
      }
    }

}
