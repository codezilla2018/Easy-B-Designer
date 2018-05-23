<?php


// print "<img src=image.png?".date("U").">";


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        // $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
}

function  create_image($imagepath){
        $username=$_POST['username'];
        $email=$_POST['email'];
        $contactno=$_POST['contactNo'];
        // echo $imagepath;
        $im = @imagecreate(336, 192) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 255, 255, 255);  // yellow
        $blue = imagecolorallocate($im, 0, 0, 255); 
        $phonetextcolor = imagecolorallocate($im, 255, 255, 255);
        $nametextcolor = imagecolorallocate($im, 0, 0, 0);
        $emailtextcolor = imagecolorallocate($im, 0, 0, 0);
        $font='fonts/tomnr.ttf';


        $overlayImage = imagecreatefromjpeg($imagepath);
        imageantialias(imagefilledrectangle ($im,   0,  140, 336,192, $blue), true);

        imagefilledrectangle ($im,   0,  0, 336,10, $blue);
        imageantialias(imagefilledrectangle ($im,   0,  0, 336,10, $blue), true);
        imageantialias(imagestring($im, 7, 5, 160,$contactno, $phonetextcolor), true);

        
        // imagestring($im, 7, 130,20, 'Sathira Umesh', $nametextcolor);
        
        imageantialias(imagettftext($im, 20, 0, 11, 21, $nametextcolor, $font, $username), true);
        imageantialias(        imagestring($im, 7,130, 40, $email, $emailtextcolor), true);

        imagecopyresampled($im, $overlayImage, 10, 20, 0, 0, 100,100,imagesx($overlayImage),imagesy($overlayImage));


        imagejpeg($im,"image.jpg");
        imagedestroy($im);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class=image-container>  
        <?php
        create_image($target_file);
        print "<img src=image.png?".date("U").">";
        ?>
     </div>
</body>
</html>