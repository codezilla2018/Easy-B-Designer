<?php
include "phpqrcode-master/qrlib.php";

// database conectivity

    $hostname="localhost";
    $password="root";
    $username="root";
    $database="businesscard";



    $conn = new mysqli($hostname, $username, $password, $database);

    if (!$conn) {
        die($conn->connect_error);
    }else{
        // echo "connected successfuly";
    }

     

// form data
$username=$_POST['username'];
$email=$_POST['email'];
$contactno=$_POST['contactNo'];
$cardimagepath="./cards"."/$username".".jpg";


// image uploader
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



function  create_image($imagepath,$username,$email,$contactno,$connection){

       
        $im = @imagecreate(336, 192) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 255, 255, 255);

        $blue = imagecolorallocate($im, 0, 0, 255); // two top  box colors of the card

        // deatils of the 
        $phonetextcolor = imagecolorallocate($im, 255, 255, 255);
        $nametextcolor = imagecolorallocate($im, 0, 0, 0);
        $emailtextcolor = imagecolorallocate($im, 0, 0, 0);

        $font='./fonts/tomnr.ttf';


        $overlayImage = imagecreatefromjpeg($imagepath);// image of the user

        imagefilledrectangle ($im,   0,  140, 336,192, $blue);
        imagefilledrectangle ($im,   0,  0, 336,10, $blue);
        imagefilledrectangle ($im,   0,  0, 336,10, $blue);
        imagestring($im, 7, 5, 160,$contactno, $phonetextcolor);
        imagettftext($im, 20, 0, 130, 60, $nametextcolor, $font, $username);
        imagestring($im, 7,130, 70, $email, $emailtextcolor);

        imagecopyresampled($im, $overlayImage, 10, 20, 0, 0, 100,100,imagesx($overlayImage),imagesy($overlayImage)); // final image

        QRcode::png("http://www.sitepoint.com", "./cards/$username.png", "L", 4, 4); // genrating qr code link for downloading

        imagejpeg($im,"./cards/$username.jpg");// creating the final image
        imagedestroy($im); // destroy the image
        $cardpath="./cards/$username.jpg";
        $qrcardpath="./cards/$username.png";

        $query= "INSERT INTO `cards` (`id`, `name`, `email`, `telephone`,`cardpath`,`qrcardpath`) VALUES (NULL, '$username', '$email', '$contactno','$cardpath','$qrcardpath')";

        $result = $connection->query($query);

       



}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

    <title>Document</title>
</head>
<body class="body">
    <div class="container">  
        <div class=" col-md-12 image-container">
            <div class="col-md-4"></div>
            <div class="col-md-4 well">
            <?php
        create_image($target_file,$username,$email,$contactno,$conn);
        print"<a download='$username.jpg' href='./cards/$username.jpg' title='ImageName'>";
         print "<img src='./cards/$username.jpg'>";
         print"</a>";
        ?>
        <?php
       print" <div class='download-button col-md-12'>Click on the image to download</div>";
        
      
        print  "<img alt='ImageName' src='./cards/$username.png'>";
       
    ?>
            </div>
            <div class="col-md-4">
           
            </div>

        </div>

     </div>

       <script src="./jquery-3.3.1.min.js"></script>
    <script src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>