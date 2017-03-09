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

    <link href="dist/css/starter-template.css" rel="stylesheet">
    <script src="dist/js/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="dist/css/sweetalert.css">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">
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
     <a href="index.php"><img src="images/assets/back.png" style="width:50px;" align="right"></a>
    <div class="container">
      <div class="col-lg-6" style="margin-top:-5%;">
        <h1>POLICE DETAILS</h1>
        <form action="#" method="POST" enctype="multipart/form-data" id="officerForm">
        <input type="hidden" name="location" value="server_officer_profiling"/>
        <label>Full Name</label>
        <input type="text" class="form-control" name="lname" placeholder="Last Name" style ="width:32%;" required>
        <input type="text" class="form-control" name="fname" placeholder="First Name" style ="width:32%;margin-top:-7.25%;margin-left:34%;" required>
        <input type="text" class="form-control" name="mname" placeholder="Middle Name" style ="width:32%;margin-top:-7.25%;margin-left:68%;" required>
        <label>Home Address</label>
        <input type="text" class="form-control" name="address" required>
        <label>Contact</label><label style="margin-left:35%;">Gender</label>
        <input type="text" class="form-control" name="height" style="width:45%;" required>
        <select name="gender" class="form-control" style="width:50%;margin-top:-7.25%;margin-left:50%;">
        <option hidden>Select Gender</option>
        <option value="Female">Female</option>    
        <option value="Male">Male</option>                  
        </select>
        <label>Birthday</label><label style="margin-left:40%;">Position</label>
        <input type="date" class="form-control" name="bday" style="width:45%;" required>
        <select name="position" class="form-control" style="width:50%;margin-top:-7.25%;margin-left:50%;" required>
          <option hidden>Position</option>
          <option value="PO1">Police Officer I</option>
          <option value="PO2">Police Officer II</option>          
          <option value="PO3">Police Officer III</option>
          <option value="PO4">Police Officer IV</option>
          <option value="SPO1">Senior Police Officer I</option>
          <option value="SPO2">Senior Police Officer II</option>
          <option value="SPO3">Senior Police Officer III</option>
          <option value="SPO4">Senior Police Officer IV</option>
          <option value="PINSP">Police Inspector</option>
          <option value="PSINSP">Police Senior Inspector</option>
        </select>
        <label>Image</label>
        <center><img id="blah" alt="Image Preview" height="100px" width="100px" ></center>
        <br>
        <input type="file" class="form-control" name="police" id='imgInp' required>
        <br>
        <button type="submit" class="btn btn-default" name="submit" id='submit' style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>
        </form>
      </div>
      <div class="col-lg-6">
        <center><img src="images/assets/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
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
            
      $('#officerForm').
      submit( function( e ){
        $.ajax({
        url: 'server_storing.php',
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(data){
          swal(data);
          document.getElementById("officerForm").reset();
          document.getElementById('blah').src = '';
        }
      })
        e.preventDefault();
      });
    </script>
  </body>
</html>
