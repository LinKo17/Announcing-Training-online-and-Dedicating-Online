<?php
include("../../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\AboutUsAndOthers;
use Helper\Auth;

$database = new AboutUsAndOthers(new MySQL());
$data = $database->takeAboutUsData();
?>
<?php
session_start();

//checking user role in here
Auth::checkUserRole();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bs ccs link -->
    <link rel="stylesheet" href="../../bs/css/bootstrap.min.css">

    <!-- bs js link -->
    <script src="../../bs/js/bootstrap.bundle.min.js" defer> </script>

    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
    </style>    

</head>
<body>
<!-- navbar section -->
<?php  require_once("contentNavbar.php") ?>
<!-- navbar section -->

<!-- showing   about us information -->
<div class="container" id="container-width">
<div class="card mt-3 g-0">

    <div class="card-header bg-primary text-light h5 text-center">About Us</div>
    <div class="card-body">
    <form action="../../_action/contact_data/about_us_data.php" method="post">
            <textarea  cols="30" rows="10" name="aboutus" class="form-control" placeholder="write about MyTechnology"  ><?= $data->about_us ?? "" ?></textarea>

            <div class="mt-2">
                <input type="radio" style="opacity:0">
                <div class="float-end">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button  class="btn btn-primary">Post</button>
                </div>
            </div>
        </form>
    </div>

    </div>        
    </div>    
</div>
<!-- showing   about us information -->
</body>
</html>