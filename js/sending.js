function sendingData(location, checkpoints){
    var checkpoint = JSON.stringify(checkpoints);
    var target = JSON.stringify(location);
    $.ajax({
        url: 'server_plottingAjax.php',
        type: 'POST',
        data:{
        	target : target,
        	checkpoints : checkpoints,
       		location : "server_plotting",
        },
        success: function(results) {
        	alert(results);
        }
    });
   }