<?php
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helper\HTTP;
use Helper\Auth;


$database = new UsersTable(new MySQL());
$data = $database->showTeacherInfo();

session_start();
$random = Auth::randomNumber();



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
    <script src="../js/bootstrap.bundle.min.js" defer> </script> 

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

    <!-- showing   teacher information -->

    <div class="container" style="width:100%;"> 
        <div class="row">
            <?php foreach($data as $item) : ?>
                <?php if($item->hide == 0): ?>
            <div class="col-lg-4  p-2 col-md-6">
                <div class="border card p-1">
                    <div class="">
                        <img src="../teacherPhotos/<?= $item->teacher_img?>" alt="" style="width:100%; height:300px;">
                    </div>
                    <h1 class="h5 text-center my-2"><?= $item->teacher_name ?></h1>
                    <div class="card-footer">
                        <a style="width:32%" href="teachers_detail.php?id=<?= $item->id?>&&rd=<?=$random?>" class="btn btn-secondary float-end">Details</a>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php endforeach ?>


        </div>
    </div>
    <!-- /showing teacher information -->  
    

    <!-- footer sectioin -->
    <div style="margin-top:300px">
        <?php include("extra_footer_teacher.php"); ?>
    </div>
    <!-- footer sectioin -->
</body>
</html>