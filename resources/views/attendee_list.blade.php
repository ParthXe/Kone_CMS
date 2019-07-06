@extends('layouts.admin')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="pull-right form-group" style="line-height: 36px;z-index: 999;cursor: pointer;width: 20%;margin-right: 2rem;margin-top: 1rem;">
  <label style="float:left;" class="col-md-6">Select Session: </label>
  <select id="sessions" name="sessions" class="form-control col-md-6" style="float:right;" onchange="filter()">
   <option value="">-Select-</option>
   <option value="1">Session 1</option>
   <option value="2">Session 2</option>
   <option value="0">Yet to Confirm</option>
   <option value="9">Show All</option>
 </select>
</div>
    <div id="table-container" style="padding: 45px 23px;">
    <div class="card-header"><b>{{ __('Attendee List') }}</b></div>
    <table id="attendee_list" class="table table-bordered">
        <tr id="first">
            <th>Id</th>
            <th>Attendee Image</th>
            <th>Attendee Name</th>
            <th>Attendee Email</th>
            <th>Attendee Contact No.</th>
            <th>Event Sessions</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($attendee_list as $attendee)
        <tr>
            <td>{{ $i++}}</td>
            <td><img src="{{ asset('dist/images/'.$attendee->profile_pic)}}" width="80px" height="80px"></img></td>
            <td>{{ $attendee->name }}</td>
            <td>{{ $attendee->email }}</td>
            <td>{{ $attendee->mobile }}</td>
            <div style="display: none;"><?php $sid=$attendee->session_id ?></div>
            <?php if($sid == 1){?>
              <td>Session 1</td>
            <?php } else if($sid == 2){?>
              <td>Session 2</td>
            <?php } else{?>
              <td>Yet to Confirm</td>
            <?php }?>
        </tr>
        @endforeach
    </table>
    <input type="hidden" id="csrf" value="{{csrf_token()}}">
  </div>
<script type="text/javascript">
  function filter(){
    var session = document.getElementById("sessions").value;
    var csrf = document.getElementById("csrf").value;
    var data = [];
    if(session != "")
    {
      $.ajax({
        url: "{{ route('filter_attendee_list') }}",
        type: "post",
        data:  {_token:csrf, message:session},
        success: function(result)
        {
            //console.log(result['attendee_list'].length);
             $n=$('#attendee_list').find("tr:gt(0)").remove();
             //console.log($n);
             $('#attendee_list').find("tr:gt(0)").append('</tr>');
             for(var i=0;i<result['attendee_list'].length;i++){
               var temp=result['attendee_list'][i]['session_id'];
               var sid;
               if(temp == "0"){
                 sid="Yet to Confirm";
               }
               else{
                 sid="Session " +result['attendee_list'][i]['session_id'];
               }

               data[i]=`<tr>
                     <td>`+result['attendee_list'][i]['id']+`</td>
                     <td><img src="/dist/images/`+result['attendee_list'][i]['profile_pic']+`" width="80px" height="80px"></img></td>
                     <td>`+result['attendee_list'][i]['name']+`</td>
                     <td>`+result['attendee_list'][i]['email']+`</td>
                     <td>`+result['attendee_list'][i]['mobile']+`</td>
                     <td>`+sid+`</td></tr>`;
                     $('#attendee_list').append(data[i]);
                     //console.log(data[i]);
             }

        }
      });
    }
  }
</script>
@endsection
