<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KONE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://localhost/Kone_CMS/public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>

  <script type="text/javascript">
  $(document).ready(function(){
    $('#downloadbtn').click(function(){
      var body= $("#content").html();
      var doc = new jsPDF("p", "pt", "letter");
      var elementHandler = {
        '#downloadiv': function (element, renderer) {
          return true;
        },
        '#homediv': function (element, renderer) {
          return true;
        }
      };

      doc.addHTML($("#content")[0], function () {
         doc.save('html.pdf');
      });
    });
  });
  </script>
</head>
<body class="hold-transition sidebar-mini" style="text-align:center;">
<div id="content" class="wrapper">
<div class="wrapper" style="margin-left:0!important;min-height: 100px !important;background: #f4f6f9!important;">
  <div class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2%!important;margin-top:1%!important;">
    <img src="../dist/img/KONE_Logo.png" alt="" width="50%">
  </div>
</div>
<div id="homediv" class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2.5%!important;margin-top:2%!important;">
    <a id="homebtn" class="btn" style="background: #0071b9;color: #fff;" href="{{ route('show_event')}}">Home</a>
</div>
<div id="downloadiv" class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;margin-right:2.5%!important;margin-top:2%!important;">
    <a id="downloadbtn" class="btn" style="background: #0071b9;color: #fff;" href="#">Download PDF</a>
</div>
  <div class="content-wrapper" style="background: #fff!important;margin-left:0!important;padding: 0px 25px;">
    <div id="table-container" style="padding: 85px 23px;">
        <div class="card-header"><b><h1>Event List</h1></b></div>
          <table class="table table-bordered">
              <tr style="background: #f4f6f9!important;">
                  <th>Id</th>
                  <th>Event Name</th>
                  <th>Speaker Name</th>
                  <th>Event Description</th>
                  <th>Event Sessions</th>
              </tr>
              <div style="display: none;">{{ $i=1 ,$j=$i-1}}</div>
              @foreach ($events as $event)
              <tr>
                  <td>{{ $i++}}</td>
                  <td>{{ $event->event_name }}</td>
                  <td>{{ $event->speaker_name }}</td>
                  <td>{{ $event->event_description }}</td>
                  <td>{{ $event_sessions[$j]->event_sessions_time }}</td>
                    <!--td>{{ $event->active }}</td-->
                  <?php $j++; ?>
              </tr>
              @endforeach
          </table>
      </div>
  </div>
<!--/div-->
<footer id="footer" class="main-footer" style="margin-left:0!important;bottom:0!important;">
  <strong>Copyright &copy; 2019-2020 <a href="#">Kone</a>.</strong>
  All rights reserved.
</footer>
</div>
