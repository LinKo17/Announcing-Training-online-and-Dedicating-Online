<?php
include("../vendor/autoload.php");
use Helper\HTTP;
use Helper\Auth;
use Libs\Database\UsersContentTable;
use Libs\Database\MySQL;


session_start();
if(isset( $_SESSION["register_member_data"])){
    $register_member_data = $_SESSION["register_member_data"];
}

$id= $_GET["id"];
$ds = $_GET["ds"];
if($_GET["rd"] != $_SESSION["checkRandomNumber"]){
    $random = Auth::randomNumber();
    HTTP::redirect("/indexDetail.php","id=$id&&rd=$random&&ds=$ds");
    // echo "wrong";
    
}
$_SESSION["register_form_back"] = true;

$ds = $_GET["ds"];

if(trim($ds) == "ho"){
     "fine";
}elseif(trim($ds) == "all"){
     "fine";
}else{
    HTTP::redirect("/index.php");
}

unset($_SESSION["button__press"]);

$database = new UsersContentTable(new MySQL());
$media_data = $database->mediaData();
// print_r($media_data);
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
        .container-width{
            width:500px;
        }
        ul li{
            cursor: default;
        }
        ul li:hover{
            background-color: black;
            color:white;
        }
        @media(max-width:500px){
            .container-width{
                width:370px;
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
    <div class="container form-width mt-2">
        <?php if(isset($_SESSION["checkPhoto"])) : ?>
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <?= $_SESSION["checkPhoto"] ?>
            <?php unset($_SESSION["checkPhoto"]) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
    </div>

    <!-- session section -->
            <div class="container-container-width-my-2 text-center">
                <div class="style-world">
                    <span>* website အတွင်း အပ်နှံလျှင် သင်တန်း အပ်ပြီးစီးကြောင်း လက်မှတ်ရမှာသာအတည်ဖြစ်မည်။</span>
                </div>
        </div>
            </div>


    <!-- join register form -->
        <div class="container my-3 container-width">

            <div class="card">
                <div class="card-header  text-white text-center fs-5 bg-primary">Register Here</div>

                <div class="card-body">

                    <form action="../_action/class_join_data/register_session_data.php" method="post" enctype="multipart/form-data">

                        <div class="my-2">
                            <input type="hidden" class="form-control" name="class_id" value="<?= $_GET["id"] ?>" required>
                        </div>

                        <div class="my-2">
                            <input type="hidden" class="form-control" name="ds" value="<?= $_GET["ds"] ?>" required>
                        </div>

                        <div class="my-2">

                            <label for="name" class="my-1">Name</label>

                            <input type="text" class="form-control <?php if(isset($_SESSION["name_wrong"])): ?> is-invalid <?php endif ?>" name="name" id="name" placeholder="Name" required value="<?=$register_member_data["stu_name"] ?? "" ?>">

                            <?php if(isset( $_SESSION["name_wrong"])): ?>
                                <span class="text-danger"><?= isset( $_SESSION["name_wrong"]) ?$_SESSION["name_wrong"] : "" ?></span>
                            <?php endif  ?>
                        </div>

                        <div class="my-2">

                            <label for="phone_number" class="my-1">Phone Number</label>

                            <input type="text" class="form-control <?php if(isset($_SESSION["phone_wrong"])): ?> is-invalid <?php endif ?>" name="ph_num" id="phone_number" placeholder="Phone Number" required value="<?=$register_member_data["stu_phone_number"] ?? "" ?>">

                            <?php if(isset( $_SESSION["phone_wrong"])): ?>
                                <span class="text-danger"><?= isset( $_SESSION["phone_wrong"]) ? $_SESSION["phone_wrong"] : "" ?></span>
                            <?php endif  ?>

                        </div>

                        <div class="my-2">
                            <label for="email" class="my-1">Email</label>
                            <input type="text" class="form-control <?php if(isset($_SESSION["email_wrong"])): ?> is-invalid <?php endif ?>" name="email" id="email" placeholder="Email" required value="<?=$register_member_data["stu_email"] ?? "" ?>">

                            <?php if(isset( $_SESSION["email_wrong"])): ?>
                                <span class="text-danger"><?= isset( $_SESSION["email_wrong"]) ? $_SESSION["email_wrong"] : "" ?></span>
                            <?php endif  ?>
                        </div>

                        <div class="my-2">
                            <label for="address" class="my-1">Address</label>
                            <textarea type="text" class="form-control" name="address" id="address" placeholder="Address" required ><?=$register_member_data["stu_address"] ?? ""?></textarea>
    
                        </div>

                        <div class="my-2">
                            <label for="choice_pay" class="my-1">Choice Payment</label>
                            <select  id="choice_pay" name="pay_system" class="form-control" required>
                                <option value="K-pay" <?php echo $register_member_data["stu_pay_system"] ?? "" == "K-pay" ? "selected" : "" ?>>KBZ Payment</option>

                                <option <?php echo $register_member_data["stu_pay_system"] ?? "" == "Wave Payment" ? "selected" : "" ?> value="Wave">Wave Payment</option>

                                <option <?php echo $register_member_data["stu_pay_system"] ?? "" == "A+ Payment" ? "selected" : "" ?> value="A+">A+ Payment</option>
                            </select>
                        </div>
    
                        <div class="my-2">
                            <label for="pay_photo">Payment Screenshot</label>
                            <input type="file" class="form-control" name="pay_photo" id="payphoto" required>
                        </div>
    
                        <div class="">
                            <div class="text-center">
                                <a href="../_action/class_join_data/register_session_destroy.php?id=<?= $_GET['id']?>&rd=<?=$random?>" class="btn btn-danger">Reset</a>
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    <!-- join register form -->

    <!-- phone number -->
    <div class="container container-width my-4">
        <ul class="list-group text-center">
            <li class="list-group-item bg-primary text-light">သင်တန်းကြေး ကိုအောက်ပါဖုန်းနံပါတ်များတွင် လွှဲ  နိုင်သည်။</li>

            <?php if(isset($media_data->phone_1)): ?>
                <li class="list-group-item"><?= $media_data->phone_1 ?></li>
            <?php endif ?>
            
            <?php if(isset($media_data->phone_2)): ?>
                <li class="list-group-item"><?= $media_data->phone_2 ?></li>
            <?php endif ?>

            <?php if(isset($media_data->phone_3)): ?>
                <li class="list-group-item"><?= $media_data->phone_3 ?></li>
            <?php endif ?>

        </ul>
    </div>
    <!-- phone number -->



    <!-- notice messages -->
  <div class="container my-3 container-width">
        <div class="style-world">
            <span>* website အတွင်း အပ်နှံလျှင် အထက်ဖော်ပြပါငွေပေးချေမှုများဖြင့်ငွေပေးချေနိုင်ပါသည်။</span>
        </div>
            
            <div class="style-world">
                <span>* သင်တန်းတွင် ကိုယ်တိုင်လာရောက်ရျ် သင်တန်း အပ်နှံ နိုင်ပါသည်။</span>
            </div>

            <div class="style-world">
                <span>* သင်တန်းသို့လာရောက်ကာ လက်ငင်းငွေချေနိုင်သည်။</span>
            </div>

        <div class="style-world">
                <span>* ငွေလွှဲပြောင်းပြီးကြောင်း ကို screenshot ရိုက်ပြီး အထက်တွင်ပြထားသည့် လေးထောင့်ကွင်း တွင်ထည့်ပေးပါ။</span>
             </div>


    
</div>
    <!-- notice messages -->

    

    <?php
        if(isset( $_SESSION["register_member_data"])){
            unset($_SESSION["register_member_data"]);
        }
        if(isset( $_SESSION["name_wrong"])){
            unset($_SESSION["name_wrong"]);
        }
        if(isset( $_SESSION["phone_wrong"])){
            unset($_SESSION["phone_wrong"]);
        }
        if(isset( $_SESSION["email_wrong"])){
            unset($_SESSION["email_wrong"]);
        }
    ?>





    
</body>
</html>