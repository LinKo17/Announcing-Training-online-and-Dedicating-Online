<?php
include("../../vendor/autoload.php");
use Helper\HTTP;
use Libs\Database\StuRegisterForm;
use Libs\Database\MySQL;
use Helper\Auth;

session_start();
if($_GET["rd"] != $_SESSION["checkRandomNumber"]){
    HTTP::redirect("/admin/request_register/adminRequestRegister.php");
}

$database = new StuRegisterForm(new MySQL());
// print_r($database->takeAllData($_GET["id"]));

$rq_data = $database->takeAllData($_GET["id"]);
$random = Auth::randomNumber();

$fileOpen = $database->changeShow($_GET["id"],1);
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
        .form-width{
            width:450px;
        }
        .photo-style{
            width:250px;
            height:350px;
        }
        td a{
            width:45%;
        }
        .confirm-btn-style{
            width:200px;
        }
        .btn-style{
            padding:10px;
            border-radius: 5px;
            display: inline-block;
        }
        @media(max-width:500px){
            .photo-style{
            width:150px;
            height:250px;
        } 
        }
        @media(max-width:450px){
            .form-width{
            width:370px;
        } 
        }
    </style>
</head>
<body>
<!-- navbar section -->
<nav class="navbar navbar-dark bg-primary">
    <div class="container">
    <a href="adminRequestRegister.php" class="navbar-brand"><span class="fs-5"><span class="text-warning fs-3">My</span>Technology</span></a>
    </div>
</nav>
<!-- navbar section -->

<!-- main part section -->
    <div class="container mt-3 ">

        <!-- about class information -->
        <table class="table table-striped table table-bordered table-hover table-primary">
    
            <tr>
                <th class="text-center bg-dark">Join class information</th>
                <th class="text-center"></th>
            </tr>
            <tr>
                <th>Batch (Class_id)</th>
                <td><?=$rq_data->batch_id ?? "" ?></td>
            </tr>
            <tr>
                <th>Course</th>
                <td><?=$rq_data->course ?? "" ?></td>
            </tr>
            <tr>
                <th>Date of Class Start</th>
                <td><?=$rq_data->class_open_date ?? "" ?></td>
            </tr>
            <tr>
                <th>Time of Class Start</th>
                <td><?=$rq_data->class_open_time ?? ""?></td>
            </tr>
            <tr>
                <th>Teacher</th>
                <td><?=$rq_data->teacher_name ?? "" ?></td>
            </tr>
            <tr>
                <th>Class Fee</th>
                <td><?=$rq_data->course_fee ?? "" ?></td>
            </tr>
    
        </table>

        <!-- register person information -->
    <table class="table table-striped table-bordered table-hover table-primary">

        <tr>
            <th class="text-center bg-dark">
                <span class="d-none d-md-inline">Register</span> person <span class="d-none d-sm-inline">information</span><span class="d-inline d-sm-none">info</span>
            </th>
            <th class="text-center"></th>
        </tr>
        <tr>
            <th>Name</th>
            <td><?=$rq_data->stu_name ?? "" ?></td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td><?=$rq_data->stu_phone_number ?? "" ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?=$rq_data->stu_email ?? "" ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?=$rq_data->stu_address ?? ""?></td>
        </tr>
        <tr>
            <th>Payment System</th>
            <td><?=$rq_data->stu_pay_system ?? "" ?></td>
        </tr>
        <tr>
            <th>Payment <span class="d-none d-md-inline">Screenshot</span><span class="d-md-none d-inline">(ss)</span></th>
            <td><img class="photo-style" src="../../user_pay_photo/<?= $rq_data->stu_pay_photo ?>" alt=""></td>
        </tr>

        <?php if($rq_data->reject != 1): ?>
        <tr>
            <th>Action</th>
            <td>
                <a href="rejectForm.php?id=<?=$rq_data->id?>&&rd=<?=$random?>" class="btn btn-danger">Reject</a>
                
                <a href="../../_action/class_join_data/verification_code.php?id=<?=$rq_data->id?>&&rd=<?=$random?>" class="btn btn-success">Send <span class="d-none d-md-inline">Verification</span></a>
            </td>
        </tr>
        <?php endif ?>

    </table>

    <!-- confirm section -->
    <table class="table table-striped table-bordered table-hover table-primary">

        <tr>
            <th class="text-center bg-dark">Register Confirm Section</th>
            <th class="text-center"></th>
        </tr>
        <tr>
            <th>Admin verification code</th>
            <td>
                <?php if($rq_data->ad_veri_code != "not yet"): ?>
                <span class="btn-style bg-warning"><?=$rq_data->ad_veri_code ?? "" ?></span>
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <th>Register verification code</th>
            <td></td>
        </tr>
        <tr>
            <th>Register Date</th>
            <td> </td>
        </tr>
        <tr>
            <th>Confirm</th>
            <td></td>
        </tr>
    </table>

    <!-- confirm section -->


    </div>
<!-- main part section -->
</body>
</html>