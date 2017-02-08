function sendingData(location, checkpoints){
    var checkpoint = JSON.stringify(checkpoints);
    var target = JSON.stringify(location);
     $.ajax({
        type: "POST",
        url: "https://interceptor.000webhostapp.com/web/web/storing.php",
        data: {
        checkpoint : checkpoint,
        target : target,
        },
        success: function(msg){ 
            alert(msg);
        }
    });
    }