@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>{{ __('Create Agenda') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('store_agenda') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">{{ __('Topic') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ old('topic') }}" required autocomplete="name" autofocus>

                                @error('topic')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="info" class="col-md-4 col-form-label text-md-right">{{ __('Information') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ old('info') }}" required autocomplete="name" autofocus>

                                @error('info')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="owner" class="col-md-4 col-form-label text-md-right">{{ __('Owner') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="owner" type="text" class="form-control @error('owner') is-invalid @enderror" name="owner" value="{{ old('owner') }}" required autocomplete="name" autofocus>

                                @error('owner')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="start_time" type="text" class="form-control @error('start_time') is-invalid @enderror" placeholder="For e.g : 08:05" name="start_time" value="{{ old('start_time') }}" required autocomplete="name" autofocus>

                                @error('start_time')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('End Time') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="end_time" type="text" class="form-control @error('end_time') is-invalid @enderror" placeholder="For e.g : 08:25" name="end_time" value="{{ old('end_time') }}" required autocomplete="name" autofocus>

                                @error('end_time')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="session_id" class="col-md-4 col-form-label text-md-right">{{ __('Session Id') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="session_id" type="text" class="form-control @error('session_id') is-invalid @enderror" name="session_id" value="{{ old('session_id') }}" required autocomplete="name" autofocus>

                                @error('session_id')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="event_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <label class="container1">
                                <input type="checkbox" name="active" id="event_active">
                                <span class="checkmark"></span>
                                </label>
                            </div>
                              <input id="session_count" type="hidden" name="session_count" value="1">
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
@endsection
