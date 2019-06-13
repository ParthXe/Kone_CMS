@extends('layouts.admin')

@section('content')

<div class="container">
  @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">
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
                          <label for="event_datetime" class="col-md-4 col-form-label text-md-right">{{ __('Select Date & Time') }}</label>
                          <div class="col-md-6">
                            <input id="datetimepicker1" type="text" name="datetimepicker">
                            <input id="events_s3" type="hidden" class="form-control @error('event_description') is-invalid @enderror" name="id" value="{{ $events[0]->id }}">
                              @error('event_description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="event_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                        <div class="col-md-6">
                            <label class="container1">
                            <input type="checkbox" name="active" {{ ( $events[0]->active == 1 ) ? 'checked=checked' : '' }}>
                            <span class="checkmark"></span>
                            </label>
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
<script type="text/javascript">
      var datetime="{{ $events[0]->datetimepicker }}";
      var res = datetime.split(/(?<=^\S+)\s/);
      var date =res[0];
      var time= res[1];
      document.getElementById("datetimepicker1").value=datetime;
      //console.log(date+" parth "+time);
      $('#datetimepicker1').datetimepicker({
        inline: true,
        sideBySide: true,
        defaultDate:date,
        defaultTime:time
      });
</script>
@endsection
