
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

    <title>THE INTERCEPTOR - TARGET PROFILE</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <style>
    body{
      background-image:url('images/assets/bg-1.jpg');
      background-repeat:no-repeat;
      background-size: 100% 190%; 
      background-color:#fbfbfb;
      background-position:center;
    }
    </style>
  </head>

  <body>
    <div class="navbar navbar-fixed-top" style="margin-top:-80px;">
      <center><img src="images/assets/header.png" style="width:400px;"></center>
    </div>

    <div class="container">
      <div class="col-lg-6" style="margin-top:-5%;">
        <h1>TARGET PERSON DETAILS</h1>
        <form action="server_storing.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="location" value="server_profiling"/>
          <label>Full Name</label>
          <input type="text" class="form-control" name="target_name" required>
          <label>Age</label><label style="margin-left:45%;">Gender</label>
          <input type="text" class="form-control" name="target_age" style="width:45%;" required>
          <select name="target_gender" class="form-control" style="width:50%;margin-top:-7.25%;margin-left:50%;">
          <option hidden>Select Gender</option>
          <option value="Female">Female</option>    
          <option value="Male">Male</option>                  
          </select>
          <label>Height</label><label style="margin-left:42%;">Committed Crime</label>
          <input type="text" class="form-control" name="target_height" style="width:45%;" required>
          <select name="target_crime" class="form-control" style="width:50%;margin-top:-7.25%;margin-left:50%;" required>
            <option hidden>Select Crime</option>
            <option value="Drug Possession">Drug Possession</option>
            <option value="Kidnapping">Kidnapping</option>
            <option value="Murder">Murder</option>
            <option value="Rape">Rape</option>
            <option value="Robbery">Robbery</option>
            <option value="Theft">Theft</option>
          </select>
          <label>Image</label>
          <center><img id="blah" alt="Image Preview" height="100px" width="100px"/></center>
          <input type="file" class="form-control" name="pic" id="imgInp" required>
          <br>

          <button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>
        </form>
      </div>
      <div class="col-lg-6">
        <center><img src="images/assets/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
    </div><!-- /.container -->

    <script>
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
        }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
    </script>
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
