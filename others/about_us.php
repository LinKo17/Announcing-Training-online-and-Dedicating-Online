<?php
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\AboutUsAndOthers;

$database = new AboutUsAndOthers(new MySQL());
$data = $database->takeAboutUsData();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bs ccs link -->
    <link rel="stylesheet" href="../bs/css/bootstrap.min.css">

    <!-- bs js link -->
    <script src="../bs/js/bootstrap.bundle.min.js" defer> </script> 

    <!-- awesome icon link -->
    <link rel="stylesheet" href="../bs/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        img{
            width:100%;
            height:500px;
        }


        select {
            flex: 1;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            width:33%;
        }
        form{
            background:#fff;
        }
        .edit-icon{
            width:50px;
            height:50px;
            border-radius:100px;
            background-color:white;
            margin:0px 2px;
            display:flex;
            position:relative;
        }
        .edit-icon:hover{
            background-color:#212529;
            color:#fff0f3;
        }
        .icon-inner-edit{
            position:absolute;
            bottom:7px;
            right:9px;
        }

        .f-size{
            font-size:30px;
        }

        .fs-edit{
            margin-top:10px;
            font-size:20px;
            color:#ffffff;
        }
        #container-width{
          width:80%;
        }

        #style_footer{
            position: absolute;
            bottom:0px;
            width:100%;
        }
        @media(max-width:900px){
          #container-width{
            width:100%;
          }
        }

        @media(max-width:500px){
         #btn-style{
          margin-top:2px;
          width:100%;
         }
        }

        @media(max-width:600px){
            select{
                padding:7px;
                font-size:14px;
                display:block;
                width:100%;
            }
            img{
                height:300px;
            }
        }

    </style>    
</head>
<body>
      <!-- navbar section -->
      <div class="navbar navbar-dark navbar-expand bg-primary">
        <div class="container">
            <a href="../index.php" class="navbar-brand"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></a>
        </div>
    </div>
    <!-- navbar section -->

<!-- showing   about us information -->
<div class="container" id="container-width">
<div class="card mt-3 g-0">

    <div class="card-header bg-primary text-light h5 text-center">About Us</div>
    <div class="card-body" style="text-indent:50px;">
            <?= $data->about_us ?? "" ?>
    </div>
    </div>        
    </div>    
</div>
<!-- showing   about us information -->     

<!-- footer section -->
<div style="margin-top:250px;">
    <?php include("extra_footer_for_others.php")?>
</div>
<!-- footer section -->
     
    
    
</body>
</html>