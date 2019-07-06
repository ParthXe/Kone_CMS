<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KONE</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var feedback_ids=[];
  var feedback_sessions_qa=[];
  var feedback_sessions_unique_q;
  var feedback_sessions_unique_a=[];
  var feedback_sessions_unique_qanda=[];
  var session_qid,qid;
  var answers=[];
  var result=[];
  var uniquea=[];
  var uniqueacount=[];
  var feedbacks = [];
  var percentages=[];
  var total=[];
  var optionA=0;
  var optionB=0;
  var optionC=0;
  var optionD=0;
  var labelA;
  var labelB;
  var labelC;
  var labelD;
  var question;
  var cId;

  Array.prototype.unique = Array.prototype.unique || function() {
          var arr = [];
  	this.reduce(function (hash, num) {
  		if(typeof hash[num] === 'undefined') {
  			hash[num] = 1;
  			arr.push(num);
  		}
  		return hash;
  	}, {});
  	return arr;
  }

  @foreach ($feedbacks as $feedback)
      feedback_ids.push('{{ $feedback->id }}');
  @endforeach
  //console.log(arr);
  var feedback_unique_ids = feedback_ids.filter(function(item, pos){
    return feedback_ids.indexOf(item)== pos;
  });

  var feedback_unique_ids_count=feedback_unique_ids.length;

  @foreach ($feedback_sessions as $feedback_session)
    feedback_sessions_qa.push('{{$feedback_session->question_id }}'+','+'{{$feedback_session->answer}}');
    //console.log(feedback_sessions_qa);

    var feedback_sessions_q=(feedback_sessions_qa.map(function (feedback_sessions_qa) {
      return feedback_sessions_qa[0];
    }));

    //console.log(feedback_sessions_q);

    var feedback_sessions_a=(feedback_sessions_qa.map(function (feedback_sessions_qa) {
      return feedback_sessions_qa[2];
    }));

  @endforeach

    //console.log(feedback_sessions_a);

    feedback_sessions_unique_q=feedback_sessions_q.unique();
    var unique_length=feedback_sessions_unique_q.length;
    //console.log(feedback_sessions_unique_q+' '+unique_length);
    var temp_arr=[];
    for(var i=0;i<unique_length;i++)
    {
      for(var j=0;j<feedback_sessions_qa.length;j++)
      {
        //console.log("i: "+i+' j: '+j+" "+feedback_sessions_qa[j][0]+' '+feedback_sessions_unique_q[i]);
        if(feedback_sessions_qa[j][0] === feedback_sessions_unique_q[i])
        {
          temp_arr.push(feedback_sessions_qa[j][2]);
        }
      }
      feedback_sessions_unique_qanda.push(temp_arr);
      temp_arr=[];
    }

    //console.log("r"+feedback_sessions_unique_qanda.length);
      function accumulator(arr) {
        var a = [], b = [], prev;

        arr.sort();
        for ( var i = 0; i < arr.length; i++ ) {
            if ( arr[i] !== prev ) {
                a.push(arr[i]);
                b.push(1);
            } else {
                b[b.length-1]++;
            }
            prev = arr[i];
        }

        return [a, b];
    }


    for(var i=0;i<unique_length;i++)
    {
      //console.log(feedback_sessions_unique_qanda[i]);
      total.push(feedback_sessions_unique_qanda[i].length);
      //console.log("total "+total)
      result=accumulator(feedback_sessions_unique_qanda[i]);
      //console.log(result);
      for(var k=0;k<result.length;k++){
        if(k==0)
        {
          uniquea.push(result[k]);
        }
        else{
          uniqueacount.push(result[k]);
        }
      }

      //
    }
      for(var k=0;k<=result.length;k++){
        //console.log("uniquea "+uniquea[k]);
        //console.log("uniqueacount "+uniqueacount[k]);
        optionA=0;
        optionB=0;
        optionC=0;
        optionD=0;
        var count=uniqueacount[k].toString().split(',');
        var count1=uniquea[k].toString().split(',');
        for(var l=0;l<count.length;l++){
        //console.log("uniquea"+count1[l]);
        //console.log(count1[l]+"->"+parseInt((count[l])*100/total[k]));
        if(count1[l]==1){
          optionA=optionA+parseInt((count[l])*100/total[k]);
          //console.log("optionA "+optionA);
        }
        else if (count1[l]==2) {
          optionB=optionB+parseInt((count[l])*100/total[k]);
          //console.log("optionB "+optionB);
        }
        else if (count1[l]==3) {
          optionC=optionC+parseInt((count[l])*100/total[k]);
          //console.log("optionC "+optionC);
        }
        else if (count1[l]==4) {
          optionD=optionD+parseInt((count[l])*100/total[k]);
          //console.log("optionD "+optionD);
        }
      }
      //console.log("optionA "+optionA+" optionB "+optionB+" optionC "+optionC+" optionD "+optionD;
      feedbacks=<?php echo json_encode($feedbacks); ?>;
        //for(var x=0; x<unique_length;x++) {
        labelA=feedbacks[k]['optionA'];
        labelB=feedbacks[k]['optionB'];
        labelC=feedbacks[k]['optionC'];
        labelD=feedbacks[k]['optionD'];
        question=feedbacks[k]['question'];
        cId='charts'+(k+1);
        //console.log(optionA,optionB,optionC,optionD,labelA,labelB,labelC,labelD,question,cId);
        drawGraph(optionA,optionB,optionC,optionD,labelA,labelB,labelC,labelD,question,cId);
    }

  function drawGraph(A,B,C,D,LA,LB,LC,LD,Q,CanvasID)
  {
    //alert(CanvasID);
    var g =document.createElement('div');
    g.setAttribute('class','col-md-12 center');
    var canvas = document.createElement('canvas');
    canvas.setAttribute('id', CanvasID);
    g.appendChild(canvas);
    document.getElementById('container').appendChild(g);
    var ctx = document.getElementById(CanvasID).getContext('2d');
    var h =document.createElement('div');
    h.setAttribute('class','col-md-12 center');
    h.setAttribute('style','color:#ccc');
    h.innerHTML="<hr style='border-bottom: 2px solid rgba(0, 0, 0,0.1);margin-bottom:2%;'>";
    document.getElementById('container').appendChild(h);

    //alert(labelA+" "+labelB+" "+labelC+" "+labelD+" "+labelE);

  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: [LA,LB,LC,LD],
          datasets: [{
              label: Q,
              data: [A,B,C,D],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 2
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
}
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
     doc.save('Feedback_Report.pdf');
  });
});
});
</script>
<body class="hold-transition sidebar-mini" style="text-align:center;">
<div id="content" class="wrapper" style="background:#fff!important;justify-content: center;
    align-items: center;">
  <div class="wrapper" style="margin-left:0!important;min-height: 100px !important;background: #f4f6f9!important;">
    <div class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2%!important;margin-top:1%!important;">
      <img src="../dist/img/KONE_Logo.png" alt="" width="50%">
    </div>
  </div>
  <div id="homediv" class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2.5%!important;margin-top:2%!important;">
      <a id="homebtn" class="btn" style="background: #0071b9;color: #fff;" href="{{ route('show_feedback')}}">Home</a>
  </div>
  <div id="downloadiv" class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;margin-right:2.5%!important;margin-top:2%!important;">
      <a id="downloadbtn" class="btn" style="background: #0071b9;color: #fff;" href="#">Download PDF</a>
  </div>
  <div id="container" class="container" style="margin-top:5%;min-height: 595px;margin-bottom:0%;"></div>
  <footer id="footer" class="main-footer" style="margin-left:0!important;bottom:0!important;">
    <strong>Copyright &copy; 2019-2020 <a href="#">Kone</a>.</strong>
    All rights reserved.
  </footer>
</div>
