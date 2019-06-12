@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('save_event') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('Event Name') }}</label>

                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ old('event_name') }}" required autocomplete="name" autofocus>

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
                                <input id="speaker_name" type="text" class="form-control @error('speaker_name') is-invalid @enderror" name="speaker_name" value="{{ old('speaker_name') }}" required autocomplete="name" autofocus>

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
                            <textarea class="form-control" style="height:150px" name="event_description" id="event_description" placeholder="Event Description"></textarea>
                              @error('department')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                          <label for="event_datetime" class="col-md-4 col-form-label text-md-right">{{ __('Select Date & Time') }}</label>
                          <div class="col-md-6">
                            <input id="datetimepicker" type="text" name="datetimepicker">
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6">
                                <label class="container1">
                                <input type="checkbox" name="active" id="event_active">
                                <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
    $('#datetimepicker').datetimepicker({
      inline: true,
      sideBySide: true,
      //theme:'dark'
    });
</script>
@endsection
