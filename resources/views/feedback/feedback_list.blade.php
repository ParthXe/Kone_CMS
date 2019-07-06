@extends('layouts.admin')

@section('content')
<div class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;">
    <a class="btn" style="background: #0071b9;color: #fff;" href="{{ route('create_feedback') }}"> Create New Feedback</a>
</div>
    <div id="table-container" style="padding: 45px 23px;">
    <div class="card-header"><b>{{ __('List of Feedbacks') }}</b></div>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Question</th>
            <th>Option A</th>
            <th>Option B</th>
            <th>Option C</th>
            <th>Option D</th>
            <th width="280px">Action</th>
        </tr>
        <div style="display: none;">{{ $i=1 }}</div>
        @foreach ($feedbacks as $feedback)
        <tr>
            <td>{{ $i++}}</td>
            <td>{{ $feedback->question}}</td>
            <td>{{ $feedback->optionA }}</td>
            <td>{{ $feedback->optionB }}</td>
            <td>{{ $feedback->optionC }}</td>
            <td>{{ $feedback->optionD }}</td>
            <td>
                <form action="" method="POST">

                    <!--a class="btn" style="background:#009472;color:#fff" href="#">Show</a-->



                    <a class="btn btn-primary" href="{{ route('edit_feedback',$feedback->id) }}">Edit</a>



                    <a class="btn btn-danger" href="{{ route('delete_feedback',$feedback->id) }}">Delete</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  </div>

@endsection
