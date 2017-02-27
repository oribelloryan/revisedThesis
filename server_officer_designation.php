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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous">
    </script>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

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

    <div class="container">
      <div class="col-xl-6" style="margin-top:-7%;" id='input_fields_wrap'>
        <h1 style="margin-bottom:3%">OFFICERS LIST</h1>
        <button class="add_field_button">Add More Fields</button>
        <form action="server_storing.php" method="POST">
                <?php
                $id = $_GET['checkpoint'];
                echo "<input type='hidden' name='checkpoint' value=$id>";
                ?>
                <input type="file" name="pic">
                <input type="hidden" name="location" value="server_officer_designation">
            <div>
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
            </div>
            <!-- Officer 1-->
            <div class="wrapper">
                <select name="title[]" class="form-control" style="width:20%;">
                <option value="SPO4">SPO4</option>
                <option value="SPO3">SPO3</option>         
                <option value="SPO2">SPO2</option>
                <option value="SPO1">SPO1</option>
                <option value="PO4">PO4</option>
                <option value="PO3">PO3</option>
                <option value="PO2">PO2</option>
                <option value="PO1">PO1</option>
                </select>
                <input type="text" class="form-control" name="officer[]" placeholder="Enter Officer Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>
                <select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">
                <option hidden>Checkpoint Position</option>
                <option value="Spokeperson">Spokeperson</option>
                <option value="Investigating">Investigating Sub-Team</option>
                <option value="Search">Search/Arresting Sub-Team</option>
                <option value="Security">Security Sub-Team</option>
                </select>
                <!--Officer 1 End-->
                 <br>
            </div>
                 <input type="text" class="form-control" name="vehicle" placeholder="Vehicle" style="margin-top:5%;margin-left:22%;width:43%;" required>
                 <input type="text" class="form-control" name="contact" placeholder="Contact" style="margin-top:5%;margin-left:22%;width:43%;" required>
                 <br>
            <button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>
        </form>
      </div>
      <div class="col-lg-6">
        <center><img src="images/assets/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
    </div><!-- /.container -->
    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".wrapper"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            
           
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                console.log(wrapper);
                 $(wrapper).append(' <div><select name="title[]" class="form-control" style="width:20%;">'+
                                    '<option value="SPO4">SPO4</option>'+
                                    '<option value="SPO3">SPO3</option>'+         
                                    '<option value="SPO2">SPO2</option>'+
                                    '<option value="SPO1">SPO1</option>'+
                                    '<option value="PO4">PO4</option>'+
                                    '<option value="PO3">PO3</option>'+
                                    '<option value="PO2">PO2</option>'+
                                    '<option value="PO1">PO1</option>'+
                                    '</select>'+
                                    '<input type="text" class="form-control" name="officer[]" placeholder="Enter Officer Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>'+
                                    '<select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">'+
                                     '<option hidden>Checkpoint Position</option>'+
                                     '<option value="Spokeperson">Spokeperson</option>'+
                                     '<option value="Investigating">Investigating Sub-Team</option>'+
                                     '<option value="Search">Search/Arresting Sub-Team</option>'+
                                     '<option value="Security">Security Sub-Team</option>'+
                                    '</select>'+
                                    ' <a href="#" class="remove_field">Remove</a><br></div>'); //add input box
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove();
            })
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
