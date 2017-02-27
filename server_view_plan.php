<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$today = date("M-d-Y");

$sql = "SELECT * FROM tbl_operations WHERE date_execute  >= CURDATE() AND mission_status LIKE 'not done'";
$results = $conn->query($sql);

function dateformatting($date){
    
return date_format(date_create($date),'M-d-Y ');
}

function dateDifference($date1, $date2){

    $d1 = new DateTime($date1);
    $d2 = new DateTime($date2);

    $diff = $d1->diff($d2);
    $diff = $diff->format('%R%a days');
    if($diff > 0){
    return array("#99FF99", $diff); //green
    }else if($diff<0){
    return array("#FBBDBC", $diff); // red
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <style>
    body{
      background-image:url('images/assets/bg-1.jpg');
      background-repeat:no-repeat;
      background-size: 100% 190%; 
      background-color:#fbfbfb;
      background-position:center;
    }
    .data_container { 
    border-radius: 50px;
    color:#444;
    border:1px solid #CCC;
    background:#DDD;
    box-shadow: 0 0 5px -1px rgba(0,0,0,0.2);
    cursor:pointer;
    max-width: 300px;
    align-self: center;
    padding: 5px;
    text-align: center;
    margin:0 auto;
    }
    .data_container:active {
    color:red;
    box-shadow: 0 0 5px -1px rgba(0,0,0,0.6);
    } 
    .data_container:hover{
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #EAF6FD), color-stop(1, #A7D8F5));
    background-image: -o-linear-gradient(bottom, #EAF6FD 0%, #A7D8F5 100%);
    background-image: -moz-linear-gradient(bottom, #EAF6FD 0%, #A7D8F5 100%);
    background-image: -webkit-linear-gradient(bottom, #EAF6FD 0%, #A7D8F5 100%);
    background-image: -ms-linear-gradient(bottom, #EAF6FD 0%, #A7D8F5 100%);
    background-image: linear-gradient(to bottom, #EAF6FD 0%, #A7D8F5 100%);
    border: #3c7fb1 solid 1px;
    }
    </style>

    <title>THE INTERCEPTOR - CREATE PLAN</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">
    <script src="dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/css/sweetalert.css">
    
    <link href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" >
  </head>
  <body>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/assets/header.png" style="width:400px;"></center>
    </div>

    <div class="container-fluid">
    <a href="index.php"><img src="images/assets/back.png" style="width:50px;" align="right"></a>
    <br>
    <br>
    <br>
    <div class="row">
    <?php echo "<center><h4 style='color:#317fba;'>".$today."</h4></center>"; ?>
    <center><h4 style="color:#317fba;">Planned Operations</h4></center>
    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="95%">
    <thead>
    <th>Id</th>
    <th>Operation</th>
    <th>Date Planned</th>
    <th>Date Executed</th>
    <th>Execution day(s) to go</th>
    </thead>
    <tbody>
    <?php
    while($result = $results->fetch(PDO::FETCH_ASSOC)){
     $d = dateDifference(dateformatting($today),dateformatting($result['date_execute']));
     $diff = $d[1];
     $id = $result['operation_id'];
     echo '<a href="#" onClick="pressed('.$id.');"><tr>';
             echo "<td>" .$id."</td>";
             echo "<td>" .$result['operation_name']."</td>";
             echo "<td>" .dateformatting($result['date_plan'])."</td>";
             echo "<td>" .dateformatting($result['date_execute'])."</td>";
             $neg = abs($diff);
            echo "<td> $neg </td>";
     echo "</tr></a>";
    }
    ?>
    </tbody>
    </table>
    </div>
<!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function(){
       var table = $('#datatable').DataTable()
                   .order( [ 4, 'asc' ] )
                   .draw();
       $('#datatable tbody').on( 'click', 'td', function () {
          var id = table.row( this ).data()[0];
          var operation = table.row( this ).data()[1];
          var today = table.row( this ).data()[4];
          if(today > 0){
                swal("Operation can't be viewed", "Operation is not available for viewing", "error");
          }else{
                swal({
                      title: "You are to proceed in the operation "+operation+"?",
                      text: "",
                      type: "",
                      showCancelButton: true,
                      confirmButtonColor: '#DD6B55',
                      confirmButtonText: 'Proceed',
                      cancelButtonText: "Cancel",
                      closeOnConfirm: false,
                      closeOnCancel: true
                    }, function(isConfirm){
                      if (isConfirm){
                         window.location.href = "server_renderingMap.php?operation_id=" + id;
                      } 
                    });
                   
               }
                  });
                  });
    </script>
  </body>
</html>
