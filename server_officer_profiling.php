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

    <title>THE INTERCEPTOR - CREATE OPERATION</title>

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
      <div class="col-xl-6" style="margin-top:-7%;">
        <h1 style="margin-bottom:3%">OFFICERS LIST</h1>
        <form action="" method="POST">
        <select name="lead" class="form-control" style="width:20%;">
        <option value="PSINSP">PSINP</option>    
        <option value="PINSP">PINSP</option>
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        </select>
        <input type="text" class="form-control" name="lead_name" placeholder="Enter Full Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="lead_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Team Leader">Team Leader</option>
        </select>
        <br>
        <!-- Officer 1-->
        <select name="of1" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of1name" placeholder="Enter Officer Name 1" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of1_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 1 End-->
        <br>
        <!-- Officer 2-->
        <select name="of2" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of2name" placeholder="Enter Officer Name 2" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of2_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 2 End-->
        <br>
        <!-- Officer 3-->
        <select name="of3" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of3name" placeholder="Enter Officer Name 3" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of3_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 3 End-->
        <br>
        <!-- Officer 4-->
        <select name="of4" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of4name" placeholder="Enter Officer Name 4" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of4_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 4 End-->
        <br>
        <!-- Officer 5-->
        <select name="of5" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of5name" placeholder="Enter Officer Name 5" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of5_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 5 End-->
        <br>
        <!-- Officer 6-->
        <select name="of6" class="form-control" style="width:20%;">
        <option value="SPO4">SPO4</option>
        <option value="SPO3">SPO3</option>         
        <option value="SPO2">SPO2</option>
        <option value="SPO1">SPO1</option>
        <option value="PO4">PO4</option>
        <option value="PO3">PO3</option>
        <option value="PO2">PO2</option>
        <option value="PO1">PO1</option>
        </select>
        <input type="text" class="form-control" name="of6name" placeholder="Enter Officer Name 6" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
        <select name="of6_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
        <option hidden>Checkpoint Position</option>
        <option value="Assault">Assault Team</option>
        <option value="Lookout">Look-out</option>
        <option value="Comm">Communication</option>
        </select>
        <!--Officer 6 End-->
        <br>
        <button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>
        </form>
      </div>
      <div class="col-lg-6">
        <center><img src="images/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
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
