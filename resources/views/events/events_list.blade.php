@extends('layouts.admin')

@section('content')
<div class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;">
    <a class="btn" style="background: #fde03c;color: #000;" href="{{ route('create_event') }}"> Create New Event</a>
</div>
    <div id="table-container" style="padding: 45px 23px;">
    <div class="card-header"><b>{{ __('Show Events') }}</b></div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Project Type</th>
            <th>Date & Time</th>
            <th width="280px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($events as $event)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $event->event_name }}</td>
            <td>{{ $event->speaker_name }}</td>
            <td>{{ $event->datetimepicker }}</td>
            <td>
                <form action="" method="POST">

                    <!--a class="btn" style="background:#009472;color:#fff" href="#">Show</a-->



                    <a class="btn btn-primary" href="{{ route('edit_event',$event->id) }}">Edit</a>



                    <a class="btn btn-danger" href="#">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>

@endsection
