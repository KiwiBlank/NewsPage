<?php
require_once "gifresize/gif_exg.php";
require_once "db_config.php";
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}




$stmt = $con->prepare('SELECT username FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$con->close();






function resizeImage256($resourceType,$image_width,$image_height) {
    $resizeWidth = 256;
    $resizeHeight = 256;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function resizeImage128($resourceType,$image_width,$image_height) {
    $resizeWidth = 128;
    $resizeHeight = 128;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function resizeImage64($resourceType,$image_width,$image_height) {
    $resizeWidth = 64;
    $resizeHeight = 64;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

if ($_FILES['fileToUpload']['size'] == 0)
{
	exit(header("Location: profile.php?result=errorImageUpload"));
}

if(isset($_POST["submit"])) {
	$imageProcess = 0;
    if(is_array($_FILES)) {
        $fileName = $_FILES['fileToUpload']['tmp_name'];
        $sourceProperties = getimagesize($fileName);


        $resizeFileName = $username;

        $uploadPath = "./uploads/";
        $fileExt = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];



        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            exit ('Sorry, your file is too large.');
            $imageProcess = 0;
        }

if ($fileExt == "jpeg" || $fileExt == "jpg" || $fileExt == "png" || $fileExt == "gif") {

	$files = glob($uploadPath."*_".$resizeFileName.'.'. '*');
	foreach($files as $file){
			if(is_file($file))
			unlink($file);
	}
 } else {
	 $imageProcess = 0;


}








        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = resizeImage256($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagejpeg($imageLayer,$uploadPath."256_".$resizeFileName.'.'. $fileExt);

								$imageLayer = resizeImage128($resourceType,$sourceImageWidth,$sourceImageHeight);
								imagejpeg($imageLayer,$uploadPath."128_".$resizeFileName.'.'. $fileExt);

								$imageLayer = resizeImage64($resourceType,$sourceImageWidth,$sourceImageHeight);
								imagejpeg($imageLayer,$uploadPath."64_".$resizeFileName.'.'. $fileExt);


                break;

            case IMAGETYPE_GIF:
                $nGif = new GIF_eXG($fileName,1);
                $nGif->resize($uploadPath."256_".$resizeFileName.'.'. $fileExt,256,256,0,1);

								$nGif = new GIF_eXG($fileName,1);
								$nGif->resize($uploadPath."128_".$resizeFileName.'.'. $fileExt,128,128,0,1);

								$nGif = new GIF_eXG($fileName,1);
								$nGif->resize($uploadPath."64_".$resizeFileName.'.'. $fileExt,64,64,0,1);


                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = resizeImage256($resourceType,$sourceImageWidth,$sourceImageHeight);
                imagepng($imageLayer,$uploadPath."256_".$resizeFileName.'.'. $fileExt);

								$imageLayer = resizeImage128($resourceType,$sourceImageWidth,$sourceImageHeight);
								imagepng($imageLayer,$uploadPath."128_".$resizeFileName.'.'. $fileExt);

								$imageLayer = resizeImage64($resourceType,$sourceImageWidth,$sourceImageHeight);
								imagepng($imageLayer,$uploadPath."64_".$resizeFileName.'.'. $fileExt);


                break;

            default:
                $imageProcess = 0;
                break;
        }
        //move_uploaded_file($file, $uploadPath. $resizeFileName. ".". $fileExt); IDK MAN
        $imageProcess = 1;
    }

	if($imageProcess == 1){
		exit(header("Location: profile.php?result=success"));

	}else{
		exit(header("Location: profile.php?result=errorImageUpload"));

	}
	$imageProcess = 0;
}
?>
