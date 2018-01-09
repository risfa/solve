<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script>
	$(document).ready(function() {
		$("#test").click(function() {
			alert("asd");
		})
		$("#test").trigger("click");
	});
</script>
<audio id="myTune" controls>
	<source src="images/siap.ogg" type="audio/ogg">
	<source src="images/siap.mp3" type="audio/mpeg">
	Your browser does not support the audio element.
</audio>
<button id="test" onclick="document.getElementById('myTune').play()">Play Music</button>