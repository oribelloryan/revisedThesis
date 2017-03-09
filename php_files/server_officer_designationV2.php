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
    <script src="js/jssor.slider-22.2.11.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:0,d:600,y:-290,e:{y:27}}],
              [{b:0,d:1000,y:185},{b:1000,d:500,o:-1},{b:1500,d:500,o:1},{b:2000,d:1500,r:360},{b:3500,d:1000,rX:30},{b:4500,d:500,rX:-30},{b:5000,d:1000,rY:30},{b:6000,d:500,rY:-30},{b:6500,d:500,sX:1},{b:7000,d:500,sX:-1},{b:7500,d:500,sY:1},{b:8000,d:500,sY:-1},{b:8500,d:500,kX:30},{b:9000,d:500,kX:-30},{b:9500,d:500,kY:30},{b:10000,d:500,kY:-30},{b:10500,d:500,c:{x:87.50,t:-87.50}},{b:11000,d:500,c:{x:-87.50,t:87.50}}],
              [{b:0,d:600,x:410,e:{x:27}}],
              [{b:-1,d:1,o:-1},{b:0,d:600,o:1,e:{o:5}}],
              [{b:-1,d:1,c:{x:175.0,t:-175.0}},{b:0,d:800,c:{x:-175.0,t:175.0},e:{c:{x:7,t:7}}}],
              [{b:-1,d:1,o:-1},{b:0,d:600,x:-570,o:1,e:{x:6}}],
              [{b:-1,d:1,o:-1,r:-180},{b:0,d:800,o:1,r:180,e:{r:7}}],
              [{b:0,d:1000,y:80,e:{y:24}},{b:1000,d:1100,x:570,y:170,o:-1,r:30,sX:9,sY:9,e:{x:2,y:6,r:1,sX:5,sY:5}}],
              [{b:2000,d:600,rY:30}],
              [{b:0,d:500,x:-105},{b:500,d:500,x:230},{b:1000,d:500,y:-120},{b:1500,d:500,x:-70,y:120},{b:2600,d:500,y:-80},{b:3100,d:900,y:160,e:{y:24}}],
              [{b:0,d:1000,o:-0.4,rX:2,rY:1},{b:1000,d:1000,rY:1},{b:2000,d:1000,rX:-1},{b:3000,d:1000,rY:-1},{b:4000,d:1000,o:0.4,rX:-1,rY:-1}]
            ];

            var jssor_1_options = {
              $AutoPlay: false,
              $Idle: 2000,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions,
                $Breaks: [
                  [{d:2000,b:1000}]
                ]
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 600);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider bullet navigator skin 01 css */
        /*
        .jssorb01 div           (normal)
        .jssorb01 div:hover     (normal mouseover)
        .jssorb01 .av           (active)
        .jssorb01 .av:hover     (active mouseover)
        .jssorb01 .dn           (mousedown)
        */
        .jssorb01 {
            position: absolute;
        }
        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
            position: absolute;
            /* size of bullet elment */
            width: 12px;
            height: 12px;
            filter: alpha(opacity=70);
            opacity: .7;
            overflow: hidden;
            cursor: pointer;
            border: #000 1px solid;
        }
        .jssorb01 div { background-color: gray; }
        .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
        .jssorb01 .av { background-color: #fff; }
        .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }

        /* jssor slider arrow navigator skin 02 css */
        /*
        .jssora02l                  (normal)
        .jssora02r                  (normal)
        .jssora02l:hover            (normal mouseover)
        .jssora02r:hover            (normal mouseover)
        .jssora02l.jssora02ldn      (mousedown)
        .jssora02r.jssora02rdn      (mousedown)
        .jssora02l.jssora02lds      (disabled)
        .jssora02r.jssora02rds      (disabled)
        */
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('images/assets/a02.png') no-repeat;
            overflow: hidden;
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }
        .jssora02l.jssora02lds { background-position: -3px -33px; opacity: .3; pointer-events: none; }
        .jssora02r.jssora02rds { background-position: -63px -33px; opacity: .3; pointer-events: none; }
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:800px;overflow:hidden;visibility:hidden;">

        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:800px;overflow:hidden;">
            <div>
                 <div class="container">
      <div class="col-xl-6" style="margin-top:-7%;" id='input_fields_wrap'>
        <h1 style="margin-bottom:3%">OFFICERS LIST</h1>
        <button class="add_field_button">Add More Fields</button>
        <br>
        <br>
        <form action="server_storing.php" method="POST" enctype="multipart/form-data">
                <?php
                $id = $_GET['id'];
                echo "<input type='hidden' name='checkpoint' value=$id>";
                ?>
                
                <input type="file" name="pic" id='imgInp'>
                <center><img id="blah" alt="Image Preview" height="100px" width="100px" ></center>
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
                <select name="title[]" class="form-control" style="width:20%;" required>
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
                <select name="designation[]" class="form-control" style="width:38%;margin-top:-7.25%;margin-left:67%;" required="">
                <option hidden>Checkpoint Position</option>
                <option value="Spokeperson">Spokeperson</option>
                <option value="Investigating">Investigating Sub-Team</option>
                <option value="Search">Search/Arresting Sub-Team</option>
                <option value="Security">Security Sub-Team</option>
                </select>
                <!--Officer 1 End-->
                 <br>
            </div>
            <div>
                <label>Vehicle</label>
                 <input type="text" class="form-control" name="vehicle" placeholder="Vehicle" style="width:43%;" required>
                 <label>Team Leader's Contact</label>
                 <input type="text" class="form-control" name="contact" placeholder="Contact" style="width:43%;" required>
                 <br>
            </div>
            <button type="submit" class="btn btn-default" name="submit" style="background-color:#2b3f6d;color:#ffffff;width:40%;">Submit</button><button type="reset" class="btn btn-default" name="cancel" style="background-color:#2b3f6d;color:#ffffff;width:40%;margin-left:45%;margin-top:-13%;">Reset</button>
        </form>
      </div>
            </div>

        </div>
        <div>
        sdas
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
            <div data-u="prototype" style="width:12px;height:12px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
    <script type="text/javascript">jssor_1_slider_init();</script>
    
      <div class="col-lg-6">
        <center><img src="images/assets/pnp.png" alt="pnp_logo" style="width:60%;margin-left:30%;opacity:0.75;margin-top:-5%;"></center>
      </div>
    
    <script>
        $(document).ready(function() {

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
