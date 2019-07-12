@extends('layouts.admin')

@section('content')
<div class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;">
    <a class="btn" style="background: #0071b9;color: #fff;" href="{{ route('create_agenda') }}"> Create New Feedback</a>
</div>
    <div id="table-container" style="padding: 45px 23px;">
    <div class="card-header"><b>{{ __('List of Agendas') }}</b></div>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Topic</th>
            <th>Information</th>
            <th>Owner</th>
            <th>Time</th>
            <th>Session Id</th>
            <th width="280px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($agendas as $agenda)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $agenda->topic}}</td>
            <td>{{ $agenda->info }}</td>
            <td>{{ $agenda->owner }}</td>
            <td>{{ $agenda->time }}</td>
            <td>{{ $agenda->session_id }}</td>
            <td>
                <form action="" method="POST">

                    <!--a class="btn" style="background:#009472;color:#fff" href="#">Show</a-->



                    <a class="btn btn-primary" href="{{ route('edit_agenda',$agenda->id) }}">Edit</a>



                    <a class="btn btn-danger" href="{{ route('delete_agenda',$agenda->id) }}">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>

@endsection
