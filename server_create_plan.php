<?php
include('db_conn.php');
$stmt= $conn->query("SELECT MAX(operation_id) as id FROM tbl_operations");
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      $last_id = $row['id'];
      $current_id = $last_id + 1;
      $_SESSION['id'] = $current_id;
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

    <title>THE INTERCEPTOR - CREATE PLAN</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">
    <style>
    body{
      background-image:url('images/bg-1.jpg');
      background-repeat:no-repeat;
      background-size: 100% 190%; 
      background-color:#fbfbfb;
      background-position:center;
    }
    </style>
  </head>

  <body>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/header.png" style="width:400px;"></center>
    </div>

    <div class="container">
      <div class="col-lg-6" style="margin-top:-5%;">
        <h1>OPERATION DETAILS</h1>
        <form action="server_storing.php" method="POST">
        <input type="hidden" name="location" value="server_create_plan"/>
        <label>Operation ID</label>
        <input type="text" class="form-control" value= "<?php echo $current_id; ?>" disabled>
        <label>Operation Name</label>
        <input type="text" class="form-control" name="operation_name" required>
        <label>Operation Password</label>
        <input type="text" class="form-control" name="operation_password" required>
        <label>Date of Execution</label>
        <input type="date" class="form-control" name="execute" required>
        <!-- <label>Number of Officers Required</label>
        <input type="number" class="form-control" name="num_officers" required> -->
        <br>
        <button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Proceed to Plotting</button><button type="submit" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Cancel Plan</button>
        </form>
      </div>
      <div class="col-lg-6">
        <center><img src="images/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
    <!--<center>
      <div class="col-lg-4">
        <img src="images/new_plan.png" class="icons">
        <p class="lead">Create New Plan</p>
      </div>
      <div class="col-lg-4">
        <img src="images/histor y.png" class="icons">
        <p class="lead">Operations History</p>
      </div>
      <div class="col-lg-4">
        <img src="images/settings.png" class="icons">
        <p class="lead">About</p>
      </div>
    </center>
    -->
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
