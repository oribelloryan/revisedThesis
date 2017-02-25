<!DOCTYPE HTML>
<HTML>
<HEAD>
</HEAD>
<BODY>
<p>Script</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
var newDate = new Date();
var date = newDate.getTime() / 1000;
console.log('Script' + date);
$.ajax({
	url: 'datePhp.php',
	type: 'POST',
	data: {
		date : date,
	},
	success: function(e){
		console.log(e);
	}
})
</script>


</BODY>
</HTML>