<?php
    require('db_conn.php');

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
    <a href="javascript:history.back()"><img src="images/assets/back.png" style="width:50px;" align="right"></a>
    <div class="container">
      <div class="col-xl-6" style="margin-top:-7%;" id='input_fields_wrap'>
        <br>
        <h1 style="margin-bottom:3%">OFFICERS LIST</h1>
        <button class="add_field_button">Add More Fields</button>
        <br>
        <br>
        <form action="server_storing.php" method="POST" enctype="multipart/form-data">
                <?php
                $id = $_GET['checkpoint'];
                echo "<input type='hidden' name='checkpoint' value=$id>";

                $police = $conn->query("SELECT * FROM police_profiling WHERE position IN ('PSINSP', 'PINSP') AND id NOT IN (SELECT cc.police_id FROM police_profiling as pp JOIN checkpoint_composition cc ON pp.id = cc.police_id JOIN checkpoints AS c ON c.id = cc.checkpoint_id WHERE pp.position IN ('PSINSP', 'PINSP') AND c.operation_id = (SELECT operation_id FROM checkpoints WHERE id = $id))");
                $i = 0;
               
                ?>
                <center><img id="blah" alt="Image Preview" height="100px" width="100px" ></center>
                <br>
                <input type="hidden" name="location" value="server_officer_designation">
            <div>
                <select name="lead" class="form-control" style="width:20%;" disabled>
                <option value="PSINSP">PSINP</option>    
                <option value="PINSP">PINSP</option>
                <option value="SPO4">SPO4</option>
                <option value="SPO3">SPO3</option>         
                <option value="SPO2">SPO2</option>
                <option value="SPO1">SPO1</option>
                </select>
                <?php
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

                ?>
                <select name="lead_pos" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required>
                <option value="" hidden>Checkpoint Position</option>
                <option value="Team Leader">Team Leader</option>
                </select>
                <br>
            </div>
            <!-- Officer 1-->
            <div class="wrapper">
                <select name="title[]" class="form-control" style="width:20%;" disabled>
                <option value="SPO4">SPO4</option>
                <option value="SPO3">SPO3</option>         
                <option value="SPO2">SPO2</option>
                <option value="SPO1">SPO1</option>
                <option value="PO4">PO4</option>
                <option value="PO3">PO3</option>
                <option value="PO2">PO2</option>
                <option value="PO1">PO1</option>
                </select>
                <?php
                $sql = "SELECT * FROM tbl_operations WHERE operation_id = $id"; 
                 $group = $conn->query("SELECT * FROM police_profiling WHERE position NOT IN ('PSINSP', 'PINSP') AND id NOT IN (SELECT cc.police_id FROM police_profiling as pp JOIN checkpoint_composition cc ON pp.id = cc.police_id JOIN checkpoints AS c ON c.id = cc.checkpoint_id WHERE pp.position NOT IN ('PSINSP', 'PINSP') AND c.operation_id = (SELECT operation_id FROM checkpoints WHERE id = $id))");
                 $i = 0;
                 while($p = $group->fetch(PDO::FETCH_ASSOC)){
                       $team[$i] = array('id' => $p['id'], 
                       'name' => $p['last_name'].", ".$p['first_name']." ".substr($p['middle_name'], 0, 1).".",
                        'position' => $p['position'],
                        'image' => $p['image']
                        );
                  $i++;
                }
                  echo "<select name='groupMembers[]' class='form-control' style='margin-top:-7.25%;margin-left:22%;width:43%;' required>";
                  echo "<option value='' hidden>Team</option>";
                  for($i = 0; $i < sizeof($team); $i++){
                  echo "<option value=".$team[$i]['id']." data-img=".$team[$i]['image']." data-position=".$team[$i]['position'].">".$team[$i]['name']."</option>";
                  }
                  echo "</select>";
                ?>
                <select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required>
                <option value="" hidden>Checkpoint Position</option>
                <option value="Spokeperson">Spokeperson</option>
                <option value="Investigating Sub-Team">Investigating Sub-Team</option>
                <option value="Search/Arresting Sub-Team">Search/Arresting Sub-Team</option>
                <option value="Security Sub-Team">Security Sub-Team</option>
                </select>
                <!--Officer 1 End-->
                 <br>
            </div>
            <div>
                <label>Vehicle</label>
                 <input type="text" class="form-control" name="vehicle" placeholder="Vehicle" style="width:43%;" required>
            </div>
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
                 // $(wrapper).append(' <div><select name="title[]" class="form-control" style="width:20%;">'+
                 //                    '<option value="SPO4">SPO4</option>'+
                 //                    '<option value="SPO3">SPO3</option>'+         
                 //                    '<option value="SPO2">SPO2</option>'+
                 //                    '<option value="SPO1">SPO1</option>'+
                 //                    '<option value="PO4">PO4</option>'+
                 //                    '<option value="PO3">PO3</option>'+
                 //                    '<option value="PO2">PO2</option>'+
                 //                    '<option value="PO1">PO1</option>'+
                 //                    '</select>'+
                 //                    '<input type="text" class="form-control" name="officer[]" placeholder="Enter Officer Name" style="margin-top:-7.25%;margin-left:22%;width:43%;" required>'+
                 //                    '<select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;">'+
                 //                     '<option hidden>Checkpoint Position</option>'+
                 //                     '<option value="Spokeperson">Spokeperson</option>'+
                 //                     '<option value="Investigating">Investigating Sub-Team</option>'+
                 //                     '<option value="Search">Search/Arresting Sub-Team</option>'+
                 //                     '<option value="Security">Security Sub-Team</option>'+
                 //                    '</select>'+
                 //                    ' <a href="#" class="remove_field">Remove</a><br></div>'); //add input box
                 $.ajax({
                  url: "designation.php",
                  type: "POST",
                  data:{
                    id: getUrl("checkpoint=")
                  },
                  success: function(data){
                    $(wrapper).append(data);
                      }
                     })
                     
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove();
                })
                  });

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

                $("button[type='reset']").on("click", function(event){
                    $('#blah').attr('src','');
                });
            });

           function readURL(input, before) {
                $('#blah').attr('src',input);
                console.log(before.before());
                }
                
           function setPosition(input, before){
                // $('select[name=lead] option[value]').text(input).change();
                // var b = before.'option:selected';
                $(before).val(input).change();
           }

          function groupFn(a){

            var p = $(a).find(':selected').attr('data-position');
            setPosition(p, $(a).before()[0].previousElementSibling);
          }
            
           function getUrl(data){
              var url = window.location.href;
              var start = url.indexOf(data);
              var id = url.substring(start);
              var value;
              function extract(){
            var equals = id.indexOf('=')+1;
            return value = id.substring(equals);
          }
          return extract();
        }
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