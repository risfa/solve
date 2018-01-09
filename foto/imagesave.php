<?php
	session_start();
	date_default_timezone_set("Asia/Bangkok");

	$dir = "upload";
	$dir2 = date("d M Y");
	$dir3 = $_SESSION['email'];
	
	//path dir
	$foldfoto = "uploads/";
	$foldfoto = $foldfoto . $dir2 ."/";
	if (!is_dir($foldfoto . $dir3)) mkdir($foldfoto . $dir3,0777,TRUE);
	$foldfoto = $foldfoto . $dir3 ."/";
	if (!is_dir('images/original/')) mkdir('images/original/',0777,TRUE);
	//end path dir
	
	$post = $_POST['img'];
	$images = explode('data:image/png;base64,', $post);
	$i = 0;
	foreach($images as $img) {
		if (strlen($img) > 1) {
			$img = str_replace(' ', '+', $img);
			$data = base64_decode($img);
			$uniq = uniqid();
			$filename = $uniq . '.png';
			$file = $foldfoto . '/' . $uniq . '.png';
			$success = file_put_contents($file, $data);
			if (!$success) {
				echo '{
					"error"		: 1,
					"message"	: "Failed save the image. Make sure you chmod the uploads folder and its subfolders to 777."
				}';
				exit;
			}
			
			rename($file,'images/original/'.$filename);
			$original = 'images/original/'.$filename;
			$frame = 'img/frame.png';
			
			$w = 154;
			$h = 110;
			
			$newImage	= imagecreatetruecolor($w,$h);
			imagealphablending($newImage,true);
			imagesavealpha($newImage,true);
			
			$images = array($original, $frame);
			foreach($images as $value) {
				$cur = imagecreatefrompng($value);
				$background = imagecolorallocate($cur, 0, 0, 0);
				imagecolortransparent($cur, $background);
				imagealphablending($cur, false);
				imagesavealpha($cur, true);		
				
				imagecopyresampled($newImage,$cur,0,0,0,0,$w,$h,710,400); 

				imagedestroy($cur);
			}
			// header('Content-Type: image/png');
			imagepng($newImage,$foldfoto.$filename);

			echo $foldfoto.$filename;
			$_SESSION['foto'] = $foldfoto.$filename;
			// $width=1000;
			// $height=700;
			// if($success != 0 || $success != "" || $success != NULL || !is_numeric($success)){
				// $src = imagecreatefrompng($file);
				// $src = image_flip($src, 'horiz');
				// $x = imagesx($src);
				// $y = imagesy($src);
				// $truecolor = imagecreatetruecolor($width,$height);
							
				// Copy and merge
				// if(!ImageCopyResampled($truecolor, $src, 0, 0, 0, 0, $width, $height,$x,$y)) {
					// print "IMAGE COPY FAILED";
					// return FALSE;
				// }
				// Output and free from memory
				// header('Content-Type: image/png');
				// if(!imagepng($truecolor, $file)) {
					// print "IMAGE CREATE FAILED";
					// return FALSE;
				// }
				// echo $src;
				// imagedestroy($src);	  
			// }
		}
		$i++;
	}
	
function image_flip($img, $type=''){
    $width  = imagesx($img);
    $height = imagesy($img);
    $dest   = imagecreatetruecolor($width, $height);
    switch($type){
        case '':
            return $img;
        break;
        case 'vert':
            for($i=0;$i<$height;$i++){
                imagecopy($dest, $img, 0, ($height - $i - 1), 0, $i, $width, 1);
            }
        break;
        case 'horiz':
            for($i=0;$i<$width;$i++){
                imagecopy($dest, $img, ($width - $i - 1), 0, $i, 0, 1, $height);
            }
        break;
        case 'both':
            for($i=0;$i<$width;$i++){
                imagecopy($dest, $img, ($width - $i - 1), 0, $i, 0, 1, $height);

            }
            $buffer = imagecreatetruecolor($width, 1);
            for($i=0;$i<($height/2);$i++){
                imagecopy($buffer, $dest, 0, 0, 0, ($height - $i -1), $width, 1);
                imagecopy($dest, $dest, 0, ($height - $i - 1), 0, $i, $width, 1);
                imagecopy($dest, $buffer, 0, $i, 0, 0, $width, 1);
            }
            imagedestroy($buffer);
        break;
    }
    return $dest;
}
?>