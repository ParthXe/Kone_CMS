@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Edit Agenda {{ $agendas[0]->id }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update_agenda',$agendas[0]->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">{{ __('Topic') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="topic" type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" value="{{ $agendas[0]->topic }}" required autocomplete="name" autofocus>

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
                                <input id="info" type="text" class="form-control @error('info') is-invalid @enderror" name="info" value="{{ $agendas[0]->info }}" autocomplete="name" autofocus>

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
                                <input id="owner" type="text" class="form-control @error('owner') is-invalid @enderror" name="owner" value="{{ $agendas[0]->owner }}" required autocomplete="name" autofocus>

                                @error('optionA')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Start Time') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <input id="start_time" type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ substr($agendas[0]->time,0, 5) }}" required autocomplete="name" autofocus>

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
                                <input id="end_time" type="text" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{substr($agendas[0]->time,12,-4) }}" required autocomplete="name" autofocus>

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
                                <input id="session_id" type="text" class="form-control @error('session_id') is-invalid @enderror" name="session_id" value="{{ $agendas[0]->session_id }}" required autocomplete="name" autofocus>

                                @error('session_id')
                                    <span class="invalid-agenda" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agenda_active" class="col-md-4 col-form-label text-md-right">{{ __('Active') }}</label>

                            <div class="col-md-6" style='margin-top:1%;'>
                                <label class="container1">
                                <input type="checkbox" name="active" {{ ( $agendas[0]->active == 1 ) ? 'checked=checked' : '' }}>
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
</div>
@endsection
