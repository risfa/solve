						<div id="preload">
							<audio src="foto/audio/beep.wav" hidden="true"></audio>
							<audio src="foto/audio/camera1.wav" hidden="true"></audio>
						</div>	
						<div id="filmroll-wrapper">
							<div id="slot-wrapper">
								<div id="slot"></div>
								<p>Your Photos</p>
							</div>
							<div id="filmroll">
								<h4>-PhotoBooth RFID-</h4>
							</div>
						</div>
						<div id="page">
							<div id="wrapper">
								<h1>PhotoBooth RFID</h1>
								
								<div id="video">
									<video id="live"  width="800px" height="560px" autoplay></video>
									<canvas id="snapshot" style="display:none"></canvas>
								</div>			
									<div id="buttonContainer">
										<a href="#" class="redButton" id="start"><br>Take Picture</a>
									</div><!-- coba lagi clear cache dlo ya okok sampe selesai ya? ok -->	
								<a href="#" id="snap" onClick="snap()"></a>
								<p class="countdown"></p>       
								<a href="foto/thanks.php" class="countdown2"></a>   
								<a href="foto/index.php" class="countdown3"></a>   
								
							</div>
						</div>
						 <script>
					video = document.getElementById("live")
					var onFailSoHard = function(e) {
						console.log('Reeeejected!', e);
					};   
					
					navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
					
					navigator.getUserMedia({video: true}, function(stream) {
						video.src = window.URL.createObjectURL(stream);
					}, onFailSoHard);  
					
					var xPosMoustache, yPosMoustache;
					
					function snap() {
						live = document.getElementById("live")
						snapshot = document.getElementById("snapshot")
						filmroll = document.getElementById("filmroll")

						// Make the canvas the same size as the live video
						snapshot.width = live.clientWidth
						snapshot.height = live.clientHeight
				
						// Draw a frame of the live video onto the canvas
						c = snapshot.getContext("2d");
						c.drawImage(live, 0, 0, snapshot.width, snapshot.height);
						
						
						// Overlay moustache
						moustache = new Image();
						v = $("#live");				
						videoPosition = v.position();
						
						xPosMoustache = 40;
						yPosMoustache = 106;
						
						c.drawImage(moustache, xPosMoustache - videoPosition.left, yPosMoustache - videoPosition.top);
				
						// Create an image element with the canvas image data
						img = document.createElement("img")
						img.src = snapshot.toDataURL("foto/image/png")
						img.style.padding = 5
						img.width = 260
						img.height = 180
				
						// Add the new image to the film roll
						filmroll.appendChild(img)
					}
			</script>
			<script src="foto/js/jquery.min.js"></script>
			<script>
				$(window).ready(function(){
					var moustache = new Image();
					moustache.onload = function (){}
				});
			</script>
			<script src="foto/js/snapstr.js"></script>
			<script src="foto/libraries/colorbox/colorbox/jquery.colorbox-min.js"></script>