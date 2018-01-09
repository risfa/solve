<?php
	require_once("process/db/db.php");
	$id = $_GET['id'];
	$jawab = $_GET['jawab'];
	$flag = $_GET['flag'];
	$getKnowledge = $db->get_results("select * from ms_jawaban where soal_id = '".$id."'");
	
	foreach($getKnowledge as $value) {
		if($value->jawaban_benar == $jawab) {
			$color = "green";
			$icon =  "<i class='fa fa-check'></i>";
			$_SESSION['score'] += 1;
		} else {
			$icon =  "<i class='fa fa-times'></i>";
			$color = "red";
		}
	
		$html = "<div style='color:".$color.";font-weight:700'> 
						".$icon." 
						".$value->knowledge."
						<input type='hidden' name='jawaban".$flag."' value='$jawab'/>
					</div>";
					
		
	}
	 if($flag == 2){
			$html2 = "<br><br>
					<button class='btn btn-lg btn-primary pull-left' type='submit'><i class='fa fa-paper-plane'></i> Lanjutkan</button>
			 ";
		}
		// echo $html2;
		echo $html;
		echo $html2;
	// }else{
		// if($_SESSION['score'] == 2) {
			// $html2 = "<center><button>Next</button></center>";
		// }
		// } else {
			// $html .= "<button>Back</button>";
		// }
		// unset($_SESSION['score']);
		
	// }
?>