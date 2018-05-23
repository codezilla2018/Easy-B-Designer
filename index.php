<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="genratecard.php" method="post" enctype="multipart/form-data">
<div>

<label for="username">  User name </label>
    <input type="text" name="username" id="username">
</div>

<div>
<label for="email">  email </label>
    <input type="email" name="email" id="email">
</div>
<div>
<label for="contactNo">  contact No </label>
    <input type="text" name="contactNo" id="contactNo">
    
</div>

<input type="file" name="fileToUpload" id="fileToUpload">




        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>
