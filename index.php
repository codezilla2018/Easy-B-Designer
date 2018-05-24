

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="./bootstrap-3.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    
   
</head>

<body>




        <div class="container">
        <form action="genratecard.php" method="post" enctype="multipart/form-data">

            <div class="row">
                <h3> Buisness card Genrator </h3>
            </div>

            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
                    <div classs="col-md-12">

                        <label class="col-md-4" for="username"> User name </label>
                        <input class="col-md-8" type="text" name="username" id="username">
                    </div>

                    <div classs="col-md-12">
                        <label class="col-md-4" for="email"> email </label>
                        <input class="col-md-8" type="email" name="email" id="email">
                    </div>
                    <div classs="col-md-12">
                        <label class="col-md-4" for="contactNo"> contact No </label>
                        <input class="col-md-8" type="text" name="contactNo" id="contactNo">

                    </div>
                    <div classs="col-md-12">
                          
                            <input  class="col-md-12  " type="file" name="fileToUpload" id="fileToUpload"> only valid jpeg
                            <input  class="col-md-offset-9 col-md-3 btn btn-primary" type="submit" value="submit" name="submit">
    
                        </div>
                    <div class="col-md-4">
                    
                </div>

                </div>
            </div>

    </form>


    </div>


    <script src="./jquery-3.3.1.min.js"></script>
    <script src="./bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
</body>

</html>