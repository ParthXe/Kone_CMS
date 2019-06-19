@extends('layouts.admin')

@section('content')

<div class="container">
  @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row justify-content-center">
     <div class="col-md-8">
         <div class="card">
           <div class="card-header"><b>Edit Event {{ $events[0]->event_name }}</b></div>
           <div class="card-body">
                  <form method="POST" action="{{ route('update_event', $events[0]->id) }}">
                      @csrf

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Event Id') }}</label>

                          <div class="col-md-6">
                              <input id="event_id" type="text" class="form-control @error('name') is-invalid @enderror" name="event_id" value="{{ $events[0]->id }}" required autocomplete="name" readonly>

                              @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('Event Name') }}</label>

                          <div class="col-md-6">
                              <input id="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ $events[0]->event_name }}" required autocomplete="name">
                              <input id="events_sl" type="hidden" class="form-control @error('event_name') is-invalid @enderror" name="id" value="{{ $events[0]->id }}">
                              @error('event_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="speaker_name" class="col-md-4 col-form-label text-md-right">{{ __('Speaker Name') }}</label>

                          <div class="col-md-6">
                              <input id="speaker_name" type="text" class="form-control @error('speaker_name') is-invalid @enderror" name="speaker_name" value="{{ $events[0]->speaker_name }}" required autocomplete="name">
                              <input id="events_s2" type="hidden" class="form-control @error('speaker_name') is-invalid @enderror" name="id" value="{{ $events[0]->id }}">
                              @error('speaker_name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="event_description" class="col-md-4 col-form-label text-md-right">{{ __('Event Description') }}</label>

                          <div class="col-md-6">
                          <textarea class="form-control" style="height:150px" name="event_description" id="event_description">{{ $events[0]->event_description }}</textarea>
                              <input id="events_s3" type="hidden" class="form-control @error('event_description') is-invalid @enderror" name="id" value="{{ $events[0]->id }}">
                              @error('event_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="event_session1" class="col-md-4 col-form-label text-md-right">{{ __('Event Session:') }}</label>

                        <div class="col-md-6" id="wrapper" style='margin-top:1%;'>

                          <button class="delete" style="background:#e0e4e6;color:red;float:right;border-radius: 50%;border-color:#fff;">
                            <span style="font-size:16px; font-weight:bold;">x</span>
                          </button>
                          <button class="add_form_field" style="background:#0071b9;float:right;color:white;border-radius: 50%;border-color:#FFF;">
                            <span style="font-size:16px; font-weight:bold;">+ </span>
                          </button>

                          @for ($x = 0; $x < $count; $x++)
                          <div class="col-md-10 event_session{{$x+1}}" style="float:left;padding:0!important;margin-bottom: 1%;">
                                  <span style="font-weight:800;margin-right:2%;float:left;">{{$x+1}}.</span>
                                    <select id="event_session{{$x+1}}_from" class="event_session{{$x+1}}_from" name="event_session{{$x+1}}_from" style="width:38%;float:left;margin-right:4%;">
                                      @foreach($event_session_time as $session_time)
                                      <?php  $session_f=$event_session[$x]->event_time_from;?>
                                       @if($session_time->time == $session_f){
                                         <option selected value="{{$session_time->time}}">{{$session_time->time}}</option>
                                       }
                                       @else{
                                         <option value="{{$session_time->time}}">{{$session_time->time}}</option>
                                       }
                                       @endif
                                     @endForeach
                                   </select>
                                  <select id="event_session{{$x+1}}_to" class="" name="event_session{{$x+1}}_to" style="width:38%;">
                                    @foreach($event_session_time as $session_time)
                                      <?php  $session_t=$event_session[$x]->event_time_to;?>
                                      @if($session_time->time == $session_t){
                                        <option selected value="{{$session_time->time}}">{{$session_time->time}}</option>
                                      }
                                      @else{
                                        <option value="{{$session_time->time}}">{{$session_time->time}}</option>
                                      }
                                      @endif
                                    @endForeach
                                  </select>
                                  @error('event_session')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                          </div>
                            @endfor
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="event_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                        <div class="col-md-6">
                            <label class="container1">
                            <input type="checkbox" name="active" {{ ( $events[0]->active == 1 ) ? 'checked=checked' : '' }}>
                            <span class="checkmark"></span>
                            </label>
                            <input id="session_count" type="hidden">
                        </div>
                      </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                  </form>
              </div>
         </div>
      </div>
    </div>
</div>
<script type="text/javascript">
var max_fields = 9;
var min_fields = 1;
var session_count,m,n;
var wrapper = $("#wrapper");
var add_button = $(".add_form_field");
var delete_button = $(".delete");

//var x = 1;
session_count=<?php echo $count;?>;
var x=session_count;

$(add_button).click(function(e) {
    e.preventDefault();
    if (x < max_fields) {
        x++;
        var html=`<div class="col-md-10 event_session`+x+`" style="float:left;padding:0!important;margin-top: 2%;">
        <span style="font-weight:800;margin-right:2%;float:left;">`+x+`.</span>
        <select id="event_session`+x+`_from" class="" name="event_session`+x+`_from" style="width:38%;float:left;margin-right:4%;">
          <option value="00:00">00:00</option>
          <option value="00:30">00:30</option>
          <option value="01:00">01:00</option>
          <option value="01:30">01:30</option>
          <option value="02:00">02:00</option>
          <option value="02:30">02:30</option>
          <option value="03:00">03:00</option>
          <option value="03:30">03:30</option>
          <option value="04:00">04:00</option>
          <option value="04:30">04:30</option>
          <option value="05:00">05:00</option>
          <option value="05:30">05:30</option>
          <option value="06:00">06:00</option>
          <option value="06:30">06:30</option>
          <option value="07:00">07:00</option>
          <option value="07:30">07:30</option>
          <option selected value="08:00">08:00</option>
          <option value="08:30">08:30</option>
          <option value="09:00">09:00</option>
          <option value="09:30">09:30</option>
          <option value="10:00">10:00</option>
          <option value="10:30">10:30</option>
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
          <option value="15:00">15:00</option>
          <option value="15:30">15:30</option>
          <option value="16:00">16:00</option>
          <option value="16:30">16:30</option>
          <option value="17:00">17:00</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
          <option value="20:00">20:00</option>
          <option value="20:30">20:30</option>
          <option value="21:00">21:00</option>
          <option value="21:30">21:30</option>
          <option value="22:00">22:00</option>
          <option value="22:30">22:30</option>
          <option value="23:00">23:00</option>
          <option value="23:30">23:30</option>
        </select>
        <select id="event_session`+x+`_to" class="" name="event_session`+x+`_to" style="width:38%;">
          <option value="00:00">00:00</option>
          <option value="00:30">00:30</option>
          <option value="01:00">01:00</option>
          <option value="01:30">01:30</option>
          <option value="02:00">02:00</option>
          <option value="02:30">02:30</option>
          <option value="03:00">03:00</option>
          <option value="03:30">03:30</option>
          <option value="04:00">04:00</option>
          <option value="04:30">04:30</option>
          <option value="05:00">05:00</option>
          <option value="05:30">05:30</option>
          <option value="06:00">06:00</option>
          <option value="06:30">06:30</option>
          <option value="07:00">07:00</option>
          <option value="07:30">07:30</option>
          <option selected value="08:00">08:00</option>
          <option value="08:30">08:30</option>
          <option value="09:00">09:00</option>
          <option value="09:30">09:30</option>
          <option value="10:00">10:00</option>
          <option value="10:30">10:30</option>
          <option value="11:00">11:00</option>
          <option value="11:30">11:30</option>
          <option value="12:00">12:00</option>
          <option value="12:30">12:30</option>
          <option value="13:00">13:00</option>
          <option value="13:30">13:30</option>
          <option value="14:00">14:00</option>
          <option value="14:30">14:30</option>
          <option value="15:00">15:00</option>
          <option value="15:30">15:30</option>
          <option value="16:00">16:00</option>
          <option value="16:30">16:30</option>
          <option value="17:00">17:00</option>
          <option value="17:30">17:30</option>
          <option value="18:00">18:00</option>
          <option value="18:30">18:30</option>
          <option value="19:00">19:00</option>
          <option value="19:30">19:30</option>
          <option value="20:00">20:00</option>
          <option value="20:30">20:30</option>
          <option value="21:00">21:00</option>
          <option value="21:30">21:30</option>
          <option value="22:00">22:00</option>
          <option value="22:30">22:30</option>
          <option value="23:00">23:00</option>
          <option value="23:30">23:30</option>
        </select>`;
        //console.log(html);
        $(wrapper).append(html); //add input box
        $('#session_count').val(x);
    }
    else
    {
        alert('You Reached the limits')
    }
});

$(delete_button).click(function(e) {
    e.preventDefault();
    var count=$('#session_count').val();
    x=count;
    if (x > min_fields)
    {
      n=x-1;
      $('.event_session'+x).remove();
      $('#session_count').val(n);
    }
    else{
      alert('Atleast One Session Needs to be scheduled')
    }
});
</script>
@endsection
