<?php
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helper\HTTP;
use Libs\Database\UsersAnotherTable;
use Libs\Database\UsersContentTable;

$database = new UsersAnotherTable(new MySQL);
$data = $database->takeCourse();

$mediaDatabase = new UsersContentTable(new MySQL);
$mediaLink = $mediaDatabase->mediaData();

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

    <!-- session section -->
    <?php session_start()?>
    <div class="container" id="container-width">
        <?php if(isset($_SESSION["send_success"])) : ?>
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <?= $_SESSION["send_success"] ?>
                <?php unset($_SESSION["send_success"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>
    
        <?php if(isset($_SESSION["send_fail"])) : ?>
            <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                <?= $_SESSION["send_fail"] ?>
                <?php unset($_SESSION["send_fail"]) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif ?>    
    </div>
    <!-- session section -->     
    
<!-- showing   courses information -->
<div class="container" id="container-width">

<div class="card mt-3 g-0">

    <div class="card-header bg-primary text-light h5 text-center">Content Us</div>

    <?php if(isset($_SESSION["userInfo"])) : ?>

        <?php if($_SESSION["userInfo"]->ban == 0):?>
            <!-- header -->
            <div class="card-body">
                <form action="../_action/contact_data/insert_contact_data.php" method="post">
                    <div class="my-2">
                    <label for="content">Content</label>
                    <textarea type="text" class="mt-1 form-control" placeholder="Content" name="content" id="content" required></textarea>
                    </div>

                    <div class="my-2">
                        <label for="gmail">Gmail</label>
                        <input type="text" class="mt-1 form-control" placeholder="Gmail" name="gmail" id="gmail" required>
                    </div>

                    <div class="my-2">
                        <input type="radio" style="opacity:0;">
                        <div class="float-end">
                                <button type="reset" class="btn btn-danger">Reset</button>
                                <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- footer -->
            <div class="card-header" style="background-color:#003566";>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="fs-edit d-inline-block">
                            Following Social Media You Can Content Us
                        </div>                
                    </div>

                    <div class="col-lg-6 col-md-6 ">
                        
                        <a href=" <?= $mediaLink->telegram ?>">
                            <div class="edit-icon d-inline-block float-end">
                                <div class="icon-inner-edit">
                                    <i class="fa-brands fa-telegram f-size"></i>
                                </div>
                            </div>
                        </a>

                        <a href=" <?= $mediaLink->viber ?>">
                            <div class="edit-icon d-inline-block float-end">
                                <div class="icon-inner-edit">
                                    <i class="fa-brands fa-viber f-size"></i>
                                </div>
                            </div>
                        </a>
                        

                        <a href="<?= $mediaLink->facebook ?>">
                                <div class="edit-icon d-inline-block float-end">
                                    <div class="icon-inner-edit">
                                        <i class="fa-brands fa-facebook f-size "></i>
                                    </div>
                                </div>
                        </a>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="card-body text-center">
                <span class="text-danger text-center fs-3">You have been Banned!!!</span>
                <br>
                <span class="text-center fs-6">Please wait for a time!!!</span>
            </div>
            
        <?php endif ?>


    <?php else :?>

        <!-- if there is no sign in it will show this -->
        <div class="card-body  text-center h4">
            You haven't Sign in or Sign Up yet!

            <br>
            <span class="h6">
                Please <a href="../log/sign_in.php">Sign In</a> or <a href="../log/sign_up.php">Sign Up</a> Here First
            </span>
        </div>

        
        <?php endif ?>
    </div>    
</div>
<!-- /showing courses information --> 

<!-- footer section -->
<div style="margin-top:200px;">
    <?php include("extra_footer_for_others.php")?>
</div>
<!-- footer section -->
    
</body>
</html>