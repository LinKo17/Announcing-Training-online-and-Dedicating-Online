<?php
// ----------- teachers table data -----------
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helper\Auth;
$database = new UsersTable(new MySQL);
$data = $database->showTeacherInfo();
// print_r($data);
// ----------- teachers table data -----------
?>

<?php
// ----------- course table data -----------
use Libs\Database\UsersAnotherTable;
$database = new UsersAnotherTable(new MySQL);
$dataCourse = $database->takeCourse();

// ----------- course table data -----------
?>
<?php
// join teacher table and course table
$dataTeacherAndCourse = $database->joinTeachersAndCoursesAll();
// join teacher table and course table
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
    <link rel="stylesheet" href="../bs/css/bootstrap.min.css">

    <!-- bs js link -->
    <script src="../bs/js/bootstrap.bundle.min.js" defer> </script>


    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
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
        .container-style{
            width:80%;
        }
        @media(max-width:600px){
            select{
                padding:7px;
                font-size:14px;
                display:block;
                width:100%;
            }
            .container-style{
            width:100%;
            }
        }
    </style>
</head>
<body>


<!-- navbar section -->
<?php require_once("adminNavbar.php"); ?>
<!-- navbar section -->

    <!-- create classes post form -->
    <div class="container" class="container-style">


    <!-- session section -->
    <?php if(isset($_SESSION["insert_post"])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION["insert_post"] ?>
        <?php unset($_SESSION["insert_post"]) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif ?>

    <?php if(isset($_SESSION["insert_post_fail"])) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION["insert_post_fail"] ?>
        <?php unset($_SESSION["insert_post_fail"]) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif ?>    
    <!-- session section -->        

    <div class="card mt-3">
        <div class="card-header bg-primary text-light h5"> Create Class Form</div>
        <div class="card-body">
            <form action="../_action/createclasspostdata.php" class="rounded" method="post" enctype="multipart/form-data">
                <div class="my-2">
                    <label for="image">Post image</label>
                    <input type="file" class="form-control" name="image" id="image" required>
                </div>
        
                <div class="my-2">
                 <label for="class_category">Category</label>
                    <select name="class_category_id" class="form-control" id="class_category" required>
                        <?php foreach($dataCourse as $item) : ?>
                            <option value="<?= $item->id?>"><?= $item->course?></option>
                            <?php endforeach ?>
                    </select>
                </div>
        
                <div class="my-2">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="2" class="form-control" required></textarea>
                </div>
        
                <div class="my-2">
                    <label for="teacher">Teacher</label>
                    <select name="teacher_id" class="form-control" id="teacher" required>
                        <?php foreach($dataTeacherAndCourse as $item): ?>
                        <option value="<?= $item->id?>">  
                        <?= $item->teacher_name?>
                        (<span class="float-end"><?= $item->c_course ?></span>)
                        </option>
                        <?php endforeach ?>
                    </select>
                </div>
    
    
                <div class="my-2">
                    <label for="">Class Date</label><br>
                    <!-- ---------- -->
                        <select name="date" id="date">
                            <?php for($i=1; $i<=31; $i++): ?>
                                <option value="<?=$i?>"><?=$i?></option>
                            <?php endfor ?>
                        </select>
                    <!-- ---------- -->
    
                    <!-- ---------- -->
                    <select name="month" id="month">
                    <?php             $months = [
                    'January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                    ];?>
    
                    <?php foreach($months as $month): ?>
                        <option value="<?=$month?>"><?=$month?></option>
                        <?php endforeach ?>
                    </select>
                    <!-- ---------- -->
    
                    <!-- ---------- -->
                    <select name="year" id="year">
                     <?php for($i=2000; $i<=2100; $i++): ?>
                        <option value="<?= $i?>"><?= $i?></option>
                        <?php endfor ?>
                        </select>
                    <!-- ---------- -->
                </div>
    
                <div class="my-2">
                    <label for="">Class Time</label><br>
                    <!-- ---------- -->
                    <select name="minute" id="minute">
                        <?php for($i=00; $i<=60; $i++): ?>
                            <option value="<?=$i?>"><?=$i . " minutes "?></option>
                            <?php endfor ?>
                        </select>
                    <!-- ---------- -->
    
                    <!-- ---------- -->
                    <select name="hour" id="hour">
                    <?php for($i=00; $i<=12; $i++): ?>
                            <option value="<?=$i?>"><?=$i . " hours"?></option>
                            <?php endfor ?>
                        </select>
                    <!-- ---------- -->
    
                    <!-- ---------- -->
                    <select name="d_n" id="year">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                        </select>
                    <!-- ---------- -->
                </div>
    
    
                <div class="my-2">
                    <input type="radio" style="opacity:0"></input>
                    <div class="float-end">
                        <button type="reset" class="btn btn-danger ms-2">Reset</button>
                    </div>
                        <div class="float-end">
                            <button type="create" class="btn btn-success ms-2">Create</button>
                        </div>
                </div>
        
    
            </form>
        </div>
    </div>
    </div>
        <!-- /create classes post form -->


</body>
</html>