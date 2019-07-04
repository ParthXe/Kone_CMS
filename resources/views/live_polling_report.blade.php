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
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  var live_polling_ids=[];
  var live_polling_sessions_qa=[];
  var live_polling_sessions_unique_q;
  var live_polling_sessions_unique_a=[];
  var live_polling_sessions_unique_qanda=[];
  var session_qid,qid;
  var answers=[];
  var result=[];
  var uniquea=[];
  var uniqueacount=[];
  var live_pollings = [];
  var percentages=[];
  var optionA=0;
  var optionB=0;
  var optionC=0;
  var optionD=0;
  var optionE=0;
  var labelA;
  var labelB;
  var labelC;
  var labelD;
  var labelE;
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

  @foreach ($live_pollings as $live_polling)
      live_polling_ids.push('{{ $live_polling->id }}');
  @endforeach
  //console.log(arr);
  var live_polling_unique_ids = live_polling_ids.filter(function(item, pos){
    return live_polling_ids.indexOf(item)== pos;
  });

  var live_polling_unique_ids_count=live_polling_unique_ids.length;

  @foreach ($polling_sessions as $polling_session)
    live_polling_sessions_qa.push('{{$polling_session->question_id }}'+','+'{{$polling_session->answer}}');
    //console.log(live_polling_sessions_qa);

    var live_polling_sessions_q=(live_polling_sessions_qa.map(function (live_polling_sessions_qa) {
      return live_polling_sessions_qa[0];
    }));

    //console.log(live_polling_sessions_q);

    var live_polling_sessions_a=(live_polling_sessions_qa.map(function (live_polling_sessions_qa) {
      return live_polling_sessions_qa[2];
    }));

  @endforeach

    //console.log(live_polling_sessions_a);

    live_polling_sessions_unique_q=live_polling_sessions_q.unique();
    var unique_length=live_polling_sessions_unique_q.length;
    //console.log(live_polling_sessions_unique_q+' '+unique_length);
    var temp_arr=[];
    for(var i=0;i<unique_length;i++)
    {
      for(var j=0;j<live_polling_sessions_qa.length;j++)
      {
        //console.log("i: "+i+' j: '+j+" "+live_polling_sessions_qa[j][0]+' '+live_polling_sessions_unique_q[i]);
        if(live_polling_sessions_qa[j][0] === live_polling_sessions_unique_q[i])
        {
          temp_arr.push(live_polling_sessions_qa[j][2]);
        }
      }
      live_polling_sessions_unique_qanda.push(temp_arr);
      temp_arr=[];
    }

    //console.log("r"+live_polling_sessions_unique_qanda.length);
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
      //console.log(live_polling_sessions_unique_qanda[i]);
      var total=live_polling_sessions_unique_qanda[i].length;
      result=accumulator(live_polling_sessions_unique_qanda[i]);
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
      for(var k=0;k<result.length;k++){
        //console.log("uniquea "+uniquea[k]);
        //console.log("uniqueacount "+uniqueacount[k]);
        optionA=0;
        optionB=0;
        optionC=0;
        optionD=0;
        optionE=0;
        var count=uniqueacount[k].toString().split(',');
        var count1=uniquea[k].toString().split(',');
        for(var l=0;l<count.length;l++){
        //console.log("uniquea"+count1[l]);
        //console.log(count1[l]+"->"+parseInt((count[l])*100/total));
        if(count1[l]==1){
          optionA=optionA+parseInt((count[l])*100/total);
          //console.log("optionA "+optionA);
        }
        else if (count1[l]==2) {
          optionB=optionB+parseInt((count[l])*100/total);
          //console.log("optionB "+optionB);
        }
        else if (count1[l]==3) {
          optionC=optionC+parseInt((count[l])*100/total);
          //console.log("optionC "+optionC);
        }
        else if (count1[l]==4) {
          optionD=optionD+parseInt((count[l])*100/total);
          //console.log("optionD "+optionD);
        }
        else if (count1[l]==5) {
          optionE=optionE+parseInt((count[l])*100/total);
          //console.log("optionE "+optionE);
        }
      }
      //console.log("optionA "+optionA+" optionB "+optionB+" optionC "+optionC+" optionD "+optionD+" optionE "+optionE);
      live_pollings=<?php echo json_encode($live_pollings); ?>;
        //for(var x=0; x<unique_length;x++) {
        labelA=live_pollings[k]['optionA'];
        labelB=live_pollings[k]['optionB'];
        labelC=live_pollings[k]['optionC'];
        labelD=live_pollings[k]['optionD'];
        labelE=live_pollings[k]['optionE'];
        question=live_pollings[k]['question'];
        cId='charts'+k;
        //console.log(optionA,optionB,optionC,optionD,optionE,labelA,labelB,labelC,labelD,labelE,question,cId);
        drawGraph(optionA,optionB,optionC,optionD,optionE,labelA,labelB,labelC,labelD,labelE,question,cId);
    }

  function drawGraph(A,B,C,D,E,LA,LB,LC,LD,LE,Q,CanvasID)
  {
    //alert(Q);
    var g = document.createElement('canvas');
    g.setAttribute('id', CanvasID);
    document.getElementById('container').appendChild(g);
    var ctx = document.getElementById(CanvasID).getContext('2d');

    //alert(labelA+" "+labelB+" "+labelC+" "+labelD+" "+labelE);

  var myChart = new Chart(ctx, {
      type: 'horizontalBar',
      data: {
          labels: [LA,LB,LC,LD,LE],
          datasets: [{
              label: Q,
              data: [A,B,C,D,E],
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
     doc.save('Live_Polling_Report.pdf');
  });
});
});
</script>
<body class="hold-transition sidebar-mini" style="text-align:center;">
<div id="content" class="wrapper" style="background:#fff!important;">
  <div class="wrapper" style="margin-left:0!important;min-height: 100px !important;background: #f4f6f9!important;">
    <div class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2%!important;margin-top:1%!important;">
      <img src="../dist/img/KONE_Logo.png" alt="" width="50%">
    </div>
  </div>
  <div id="homediv" class="pull-left" style="line-height: 36px;z-index: 999;cursor: pointer;margin-left:2.5%!important;margin-top:2%!important;">
      <a id="homebtn" class="btn" style="background: #0071b9;color: #fff;" href="{{ route('show_live_polling')}}">Home</a>
  </div>
  <div id="downloadiv" class="pull-right" style="line-height: 36px;z-index: 999;cursor: pointer;margin-right:2.5%!important;margin-top:2%!important;">
      <a id="downloadbtn" class="btn" style="background: #0071b9;color: #fff;" href="#">Download PDF</a>
  </div>
  <div id="container" class="container" style="margin-top:10%;"></div>
  <footer id="footer" class="main-footer" style="margin-left:0!important;bottom:0!important;">
    <strong>Copyright &copy; 2019-2020 <a href="#">Kone</a>.</strong>
    All rights reserved.
  </footer>
</div>
