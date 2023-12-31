<?php
include("vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Libs\Database\UsersAnotherTable;
use Helper\HTTP;
use Helper\Auth;

session_start();
if($_GET["rd"] != $_SESSION["checkRandomNumber"]){
    if(!isset($_SESSION["register_form_back"])){
        HTTP::redirect("/index.php");
    }
}
$random = Auth::randomNumber();

$database = new UsersTable(new MySQL());
$id = $_GET["id"];
$data = $database->joinClassPostsAndTeachersDetailShow($id);
// print_r($data);
//---------------- time management ----------
$timeString = $data[0]->class_time;

// Split the time string into its components
list($dbminute, $dbhours, $ampm) = explode('/', $timeString);
// echo $dbminute . "<br>";
// echo $dbhours . "<br>";
// echo $ampm . "<br>";


//---------------- /time management ----
?>
<?php
//----- join class_posts table and courses table to show course name
$database = new UsersAnotherTable(new MySQL());
$dataCourseName = $database->joinClassPostsAndCourses($id);

if(!isset($dataCourseName[0]->c_course) || !isset($data[0]->t_name)){
    HTTP::redirect("/index.php");
    echo "home";
}

//----- /join class_posts table and courses table to show course name
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

        #btn-style a{
            width:100%;
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
            <a href="index.php" class="navbar-brand"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></a>
            <div class="navbar-nav">
                <?php if($_GET["ds"] === "all") : ?>
                <a href="getMoreClassInfo.php" class="btn btn-dark nav-link active">Back</a>
                <?php else : ?>
                    <a href="index.php" class="btn btn-dark nav-link active">Back</a>
                <?php endif ?>


            </div>
        </div>
    </div>
    <!-- navbar section -->

    <!-- class information -->
    <div class="container mt-2 mb-4">
        <ul class="list-group">
            <li class="list-group-item">
                <img src="classPostPhotos/<?= $data[0]->image ?>" alt="">
            </li>
            <li class="list-group-item">
                <h1 class="h5 text-center"><?= $dataCourseName[0]->c_course ?></h1>
            </li>
            <li class="list-group-item"><?= $data[0]->description ?></li>
            <li class="list-group-item">
                Teacher : 
                <?= $data[0]->t_name ?>
            </li>
            <li class="list-group-item">
                Class Start : <?= $data[0]->class_date ?>
            </li>
            <li class="list-group-item">
                Class Time : <?= $dbhours . "hrs: " . $dbminute . "mins  (" . $ampm . ")"?>
            </li>
            <li class="list-group-item">


            
            <?php if(trim($data[0]->wait) == "wait") : ?>

                <!-- <div id="btn-style">
                        <a href="" class="btn btn-outline-secondary">Wait</a>
                        <div class="mt-3 mb-2">
                            <span>* ခဏစောင့်ပေးပါ။</span><br>
                        </div>
                        <div class="my-1">
                            <span>* ခလုတ် စိမ်းသွားရင် သင်တန်း ကိုပြန် join လို့ရပါပြီး။</span>
                        </div>
                </div> -->

                 <?php if(trim($data[0]->open_close) == "close"):?>

                        <div id="btn-style">
                            <a href="" class="btn btn-outline-danger">Close</a>

                            <div class="mt-3 mb-2">
                                <span>* သတ်မှတ်ထားသော သင်တန်းသား ဉီးရေပြည့်သွားပါပြီး။</span>
                            </div>

                            <div class="my-1">
                                <span>* မကြာမီ နောက်ထပ် တန်းသစ် ပြန်ဖွင့်မည်ဖြစ်တယ်</span>
                            </div>
                        </div>

                <?php else : ?>

                        <div id="btn-style">
                            <a href="" class="btn btn-outline-secondary">Wait</a>
                            <div class="mt-3 mb-2">
                                <span>* ခဏစောင့်ပေးပါ။</span><br>
                            </div>
                            <div class="my-1">
                                <span>* ခလုတ် စိမ်းသွားရင် သင်တန်း ကိုပြန် join လို့ရပါပြီး။</span>
                            </div>
                        </div>

                <?php endif ?>

                
            <?php else : ?>

                <?php if(trim($data[0]->open_close) == "open"):?>

                        <div id="btn-style">
                            <a href="class_join/register_form.php?id=<?= $data[0]->id?>&&rd=<?=$random?>&&ds=<?=$_GET["ds"]?>" class="btn btn-outline-success">Join</a>
                            <div class="mt-3 mb-2">
                                <span>* သင်တန်းကိုစိတ်ဝင်စားတယ်ဆိုရင် အခုပဲ join နိုင်ပါတယ်။</span>
                            </div>
                        </div>
                        
                <?php elseif(trim($data[0]->open_close) == "close"):?>
                    
                        <div id="btn-style">
                            <a href="" class="btn btn-outline-danger">Close</a>

                            <div class="mt-3 mb-2">
                                <span>* သတ်မှတ်ထားသော သင်တန်းသား ဉီးရေပြည့်သွားပါပြီး။</span>
                            </div>

                            <div class="my-1">
                                <span>* မကြာမီ နောက်ထပ် တန်းသစ် ပြန်ဖွင့်မည်ဖြစ်တယ်</span>
                            </div>
                        </div>                  
                    
                <?php endif ?>
            <?php endif ?>
            
            

                


                
            </li>
        </ul>
    </div>
    <!-- /class information --> 
    
    <!-- refresh section -->
<div class="container form-width mt-2">
        <?php if(isset($_SESSION["register_member_data"])) : ?>
        <div class="alert  alert-dismissible fade show " role="alert">
            <?php unset($_SESSION["register_member_data"]) ?>
        </div>
        <?php endif ?>
    </div>
<!-- refresh section -->


    <!-- footer -->
        <?php include("index_footer.php"); ?>
    <!-- footer -->
    
</body>
</html>