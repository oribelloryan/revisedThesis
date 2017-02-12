   function saveMarker(e){
     swal({
          title: "Are you sure to save this marker ?",
          text: "This would be seen by the deployed police",
          type: "",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Save',
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true
          },
      function(isConfirm){
      if(isConfirm){
      var value = e.getAttribute('data-value');
      // console.log(value);
      var i;
    
        for(i = 0; i < markers.length; i++){
        if(markers[i].get('id') == value){
        console.log(markers[i].position.lat());
        $.ajax({
          url: "server_saving_breached.php",
          type: "post",
          data:{
            id: oppId,
            lat: markers[i].position.lat(),
            lng: markers[i].position.lng(),
            name: 'breached_checkpoint',
            src: 'save'
          },
          success: function(e){
            alert(e);
            e.style.visibility = 'hidden'
          // updateSaveMarker();
          }
        });
        swal("Checkpoint Save","","success");
        }
      }
      }
      });
    }
