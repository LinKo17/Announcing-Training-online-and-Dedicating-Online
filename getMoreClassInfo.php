<?php
include("vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\UsersAnotherTable;
use Helper\HTTP;
use Helper\Auth;

$db = new UsersAnotherTable(new MySQL);
$data = $db->joinClassPostsAndCoursesAll();

session_start();
$random =  Auth::randomNumber();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bs ccs link -->
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">

    <!-- bs js link -->
    <script src="js/bootstrap.bundle.min.js" defer> </script>

    <style>
    body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
    </style>

</head>
<body style="font-family: Arial, sans-serif;background-color: #f0f0f0;margin: 0;padding: 0;">
    <!-- navbar section -->
    <div class="navbar navbar-dark navbar-expand bg-primary">
        <div class="container">
            <a href="index.php" class="navbar-brand"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></a>
        </div>
    </div>
    <!-- navbar section -->

<!-- showing class  post information -->
<div class="container" style="width:100%;"> 
    <div class="row">
        <?php foreach($data as $item) : ?>
        <div class="col-lg-4  p-2 col-md-6">
            <div class="border card p-1">
                <div class="card-body">
                    <img src="classPostPhotos/<?= $item->image?>" alt="" style="width:100%; height:200px;">
                    <h1 class="h5 text-center my-2"><?= $item->c_course ?></h1>
                </div>
                <div class="card-footer">
                    <a style="width:32%" href="indexDetail.php?id=<?= $item->id?>&&rd=<?=$random?>&&ds=all" class="btn btn-secondary float-end">Details</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>


    </div>
</div>
<!-- /showing class post information -->        

    <!-- footer -->
    <div style="margin-top:300px;">
        <?php include("index_footer.php"); ?>
    </div>
    <!-- footer -->
</body>
</html>