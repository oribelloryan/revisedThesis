<?php
  include("db_conn.php");
  $id = $_GET['id'];

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
      
         <!--  -->
        <?php
        $sql = "SELECT * FROM checkpoints WHERE operation_id = $id"; 
        $result = $conn->query($sql);
        $counter = 1;
        echo  '<form action="#" method="POST">';
        while($checkpts = $result->fetch(PDO::FETCH_ASSOC)){
         
        echo '<section id="section01" class="form-control" style="width:100%">';
        echo '<span style="margin-left:90px;"></span><a href="#section02" style="margin-left:350px;">Next</a>';
        echo '<h4>Checkpoint #'.$counter.'</h4>';
        echo '<h5>Checkpoint name: '.$checkpts['name'].'</h5>';
        echo '<h6>Location: '.$checkpts['location'].'</h6>';
       
        echo  '<button class="add_field_button">Add More Fields</button>';
       
    
                $id = $_GET['id'];
                echo "<input type='hidden' name='checkpoint' value=$id>";
                echo  '<input type="hidden" name="location" value="server_officer_designation">';
        
                
                echo  '<center><img id="blah" alt="Image Preview" height="100px" width="100px" ></center>';
               
                echo  '<div>';
                echo  '<select name="lead" class="form-control" style="width:20%;" disabled>';
                echo  '<option value="PSINSP">PSINP</option>';
                echo  '<option value="PINSP">PINSP</option>';
                echo  '<option value="SPO4">SPO4</option>';
                echo  '<option value="SPO3">SPO3</option>';         
                echo  '<option value="SPO2">SPO2</option>';
                echo  '<option value="SPO1">SPO1</option>';
                echo  '</select>';
              
               
               $police = $conn->query("SELECT * FROM police_profiling WHERE position IN ('PSINSP', 'PINSP')");
               $i = 0;
               while($p = $police->fetch(PDO::FETCH_ASSOC)){
                     $leader[$i] = array('id' => $p['id'], 
                     'name' => $p['last_name'].", ".$p['first_name']." ".substr($p['middle_name'], 0, 1).".",
                      'position' => $p['position'],
                      'image' => $p['image']
                      );
                              $i++;
                }
                echo "<select name='leaderName' class='form-control' style='margin-top:-7.25%;margin-left:22%;width:43%;' required>";
                echo "<option value='' hidden>Team Leader</option>";
                for($i = 0; $i < sizeof($leader); $i++){
                echo "<option value=".$leader[$i]['id']." data-img=".$leader[$i]['image']." data-position=".$leader[$i]['position'].">".$leader[$i]['name']."</option>";
                }
                echo "</select>";
                
               
                echo  '<select name="lead_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required>';
                echo  '<option value="" hidden>Checkpoint Position</option>';
                echo  '<option value="Team Leader">Team Leader</option>';
                echo  '</select>';
                echo  '<br>';
                echo  '</div>';
           
                echo  '<div class="wrapper">';
                echo  '<select class="form-control" style="width:20%;" required disabled>';
                echo  '<option value="SPO4">SPO4</option>';
                echo  '<option value="SPO3">SPO3</option>';         
                echo  '<option value="SPO2">SPO2</option>';
                echo  '<option value="SPO1">SPO1</option>';
                echo  '<option value="PO4">PO4</option>';
                echo  '<option value="PO3">PO3</option>';
                echo  '<option value="PO2">PO2</option>';
                echo  '<option value="PO1">PO1</option>';
                echo  '</select>';
              
               $sql = "SELECT * FROM tbl_operations WHERE operation_id = $id"; 
               $group = $conn->query("SELECT * FROM police_profiling WHERE position NOT IN ('PSINSP', 'PINSP')");
               $i = 0;
               while($p = $group->fetch(PDO::FETCH_ASSOC)){
                     $team[$i] = array('id' => $p['id'], 
                     'name' => $p['last_name'].", ".$p['first_name']." ".substr($p['middle_name'], 0, 1).".",
                      'position' => $p['position'],
                      'image' => $p['image']
                      );
                $i++;
                }
                echo "<select name='groupMembers[]' onChange='groupMembersfn(this)' class='form-control' style='margin-top:-7.25%;margin-left:22%;width:43%;' required>";
                echo "<option value='' hidden>Team</option>";
                for($i = 0; $i < sizeof($team); $i++){
                echo "<option value=".$team[$i]['id']." data-img=".$team[$i]['image']." data-position=".$team[$i]['position'].">".$team[$i]['name']."</option>";
                }
                echo "</select>";
                echo  '<select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required="">';
                echo  '<option hidden>Checkpoint Position</option>';
                echo  '<option value="Spokeperson">Spokeperson</option>';
                echo  '<option value="Investigating">Investigating Sub-Team</option>';
                echo  '<option value="Search">Search/Arresting Sub-Team</option>';
                echo  '<option value="Security">Security Sub-Team</option>';
                echo  '</select>';
              
                 echo  '<br>';
            echo  '</div>';
            echo  '<div>';
                echo  '<label>Vehicle</label>';
                 echo  '<input type="text" class="form-control" name="vehicle" placeholder="Vehicle" style="width:43%;" required>';
                 echo  '<br>';
            echo  '</div>';
            
        
        echo  '</section>';
        $counter++;
        }
        echo  '<button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>';
        echo  '</form>';
        ?>
        <section id="section02" class="form-control">
          <a href="#section03"><span></span>Next Checkpoint</a>
        </section>
        tas yung sa next na form para sa may checkpoint 2 ganito:
        <section id="section03" class="form-control">
          FORM 2
          <a href="#section04"><span></span>Next Checkpoint</a>
        </section>
        tas yung sa next na form para sa may checkpoint 2 ganito:
        <section id="section04" class="form-control">
          FORM 2
          <a href="#section03"><span></span>Next Checkpoint</a>
                <a href="#section01"><span></span>Previous Checkpoint</a>
        </section>
      </div>
      <div class="col-lg-6">
        <center><img src="images/assets/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
    </div><!-- /.container -->
      <!-- <input type="text" class="form-control" name="officer[]" placeholder="Enter Officer Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required> -->
    <!--  <input type="text" class="form-control" name="lead_name" placeholder="Enter Full Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required> -->
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
      function readURL(input, before) {
                $(before).attr('src',input);
                console.log(before.before());
                }
                
      function setPosition(input, before){
                // $('select[name=lead] option[value]').text(input).change();
                // var b = before.'option:selected';
                $(before).val(input).change();
      }

        $("select[name=leaderName]").change(function(){
                var h = $('select[name=leaderName] option:selected').attr('data-img');
                var p = $('select[name=leaderName] option:selected').attr('data-position');
                readURL(h, $(this).before()[0].previousElementSibling);
                setPosition(p, $(this).before()[0].previousElementSibling);
                // console.log(p);
                console.log($(this).before()[0].previousElementSibling);
                console.log(h);
        });

        $("select[name^=groupMembers]").change(function(){
                // var h = $('select[name^=groupMembers] option:selected').attr('data-img');
                var p = $('select[name^=groupMembers] option:selected').attr('data-position');
                // readURL(h);
                setPosition(p, $(this).before()[0].previousElementSibling);
                // console.log(p);
                console.log($(this).before());
                // console.log(h);
        });

        function groupMembersfn(input){
              
        }

        $('#officerForm').
        submit( function( e ){
          console.log(new FormData(this));
        //   $.ajax({
        //   url: 'server_storing.php',
        //   type: 'POST',
        //   data: new FormData(this),
        //   processData: false,
        //   contentType: false,
        //   success: function(data){
        //     swal(data);
        //     document.getElementById("officerForm").reset();
        //     document.getElementById('blah').src = '';
        //   }
        // })
          e.preventDefault();
        });
    </script>
  </body>
</html>
