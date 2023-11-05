<?php
include("../vendor/autoload.php");
use Helper\HTTP;
use Libs\Database\StuRegisterForm;
use Libs\Database\MySQL;


$id=$_GET["zix"];
$database = new StuRegisterForm(new MySQL());
$data = $database->takeAllData($id);

session_start();
if(!isset($_SESSION["loading"] )){
    unset($_SESSION["loading"]);
    HTTP::redirect("/index.php");
}

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
        .underline{
            border: 1px dotted black;
            width:100%;
            border-radius: 10px;
            padding:10px;
            display: inline-block;
        }
        .label-style{
            padding:10px;
        }
        .style-world{
            margin:17px 0px;
            opacity: 0.7;
            color: red;
            cursor: default;
        }
        .style-world:hover{
            color:black;
            text-decoration: underline;
        }
        .container-style{
            margin-top:20px;
        }   
    </style>
</head>
<body>
        <!-- main part on this file -->
        <div class="container container-style">
            <div class="card">

                <div class="card-header bg-primary">
                <span class="fs-5"><span class="text-warning fs-3">My</span><span class="text-light">Technology</span></span>
                <button class="btn btn-dark float-end">
                    <?= $data->registered_date_time ?>
                </button>
                </div>

                <div class="card-body">

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Name</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                                <?= $data->stu_name ?>
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Date/Time</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                            <?= $data->class_open_date ?>
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Class</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                            <?= $data->course ?>
                            (<?= $data->teacher_name ?>)
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Email</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                            <?= $data->stu_email ?>
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Phone</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                            <?= $data->stu_phone_number ?>
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-2 col-12 fs-5 label-style">Fee</div>
                        <div class="col-md-10 col-12">
                            <span class="underline">
                            <?= $data->course_fee ?>
                            </span>
                        </div>
                    </div>

                </div>
                <div class="card-footer">

                <div class="row">
                        <div class="col-6">
                            <div class="my-1 fs-5"><?= $data->ad_name ?></div>
                        </div>
                        <div class="col-6">
                            <a href="../index.php" class="btn btn-primary float-end">Get</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main part on this file -->

        <!-- message for notice -->
        <div class="container">

            <div class="style-world text-center">
                <span>* အခုပြထားသော သင်တန်း ချက်လက်မှတ် ကို screenshot ထားနိုင်ပါသည်။</span>
            </div>

        </div>
        <!-- message for notice -->

</body>
</html>