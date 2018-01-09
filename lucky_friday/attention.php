<?php
include 'spg_login.php';
$peserta=$user_sessions->get('currentPeserta');
$namaPeserta=$peserta['nama'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "header-title.php"; ?>
  </head>
  <body>
    <!-- Fixed navbar -->
        <?php include "header.php"; ?>
			<div class="col-lg-8 col-lg-offset-2" style="border-radius:10px;padding:0px 50px 50px 50px;" id="ready">
					<center><h3 class="page-header" style="border-color:#00468c">Klik tombol "Mulai Acak"</h3></center>
					<center>
					<button class="btn btn-block btn-lg btn-primary" id="acakBtn" style="display:none;">Mulai Acak</button>
					</center>
					<br>
                    <p align="center">
                        Menangkan hadiah-hadiah menarik dari Pertamina. Grand Prize Samsung S7!
                    </p>
			</div>
            <div class="col-lg-8 col-lg-offset-2" style="display:none;border-radius:10px;padding:0px 50px 50px 50px;" id="acak">
                <center><h3 class="page-header" style="border-color:#00468c">Semoga beruntung!</h3></center>
                <center>
                    <form action="process/do-get-prize.php" method="post">
                        <h4><div id="output">Nama hadiah disini (ruffle)</div></h4><br>
                        <div id="nextPage"><button type="button" class="btn btn-block btn-lg btn-primary" id="stop">Berhenti</button></div>
                        <input type="hidden" id="hidden" name="prize"/>
                        <!--<div id="nextPage"></div>-->
                    </form>
                </center>
                <br>
            </div>
            <div class="col-lg-8 col-lg-offset-2" style="display: none;border-radius:10px;padding:0px 50px 50px 50px;" id="finish">
                <center><h3 class="page-header" style="border-color:#00468c">Terima kasih atas partisipasi anda</h3></center>
                <br>
                <p align="center">
                    Selamat untuk <span style="text-transform: capitalize;font-weight: bold"><?=$namaPeserta?></span> telah mendapatkan hadiah <span id="namaHadiah" style="font-weight: bold"></span>. Semoga Anda selamat sampai tujuan.
                </p>
                <center>
                    <small><a href="form-data.php">&#8592; Kembali</a></small>
                </center>
                <br>
                <br>
            </div>
		</div>

    </div> <!-- /container -->
	<br><br>
	<?php include "footer.php"; ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script>
        var namaHadiah="";
        var hadiah=[];
        var ruffle=null;
        $(document).ready(function () {
            $.ajax({
                url : "process/get-peluang.php",
								cache: false,
                success : function (resp) {
                    hadiah=JSON.parse(resp);
										$('#acakBtn').show();
										$('#acakBtn').click(function () {
												$('#acak').show();
												$('#ready').hide();
												ruffle=setInterval(function () {
														var rufflePosition=Math.floor(Math.random() * (hadiah.length-1));
														$('#output').html(hadiah[rufflePosition]);
														namaHadiah=hadiah[rufflePosition];
												},10);
										});
										$('#stop').click(function () {
												$('#acak').hide();
												clearInterval(ruffle);
												$.ajax({
														cache: false,
														url : "process/ambil-hadiah.php",
														method : 'POST',
														data : {
																hadiah : namaHadiah
														},
														success : function (resp) {
																$('#finish').show();
																$('#acak').hide();
																$('#namaHadiah').html(namaHadiah);
														},
														failure : function (err) {
															$('#acak').show();
														}
												});
										});
                },
                failure : function (err) {
                }
            });
        });
    </script>
  </body>
</html>
