<?php
include("../vendor/autoload.php");
use Helper\HTTP;
use Libs\Database\MySQL;
use Libs\Database\StuRegisterForm;

session_start();

if(isset($_SESSION["loading_file"]) || isset($_SESSION["loading"])){
    unset($_SESSION["loading_file"]);
    unset($_SESSION["loading"]);
}


if(!isset($_SESSION["rejection"])){
    HTTP::redirect("/index.php");
    // echo "error is here";


}


$database = new StuRegisterForm(new MySQL());
$rej_reason = $database->rejectReasonTaker($_GET["stu"]);
// print_r($rej_reason);
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
            width:500px;
        }
        .rejcet-reason-style .reject-style{
            color:red;
            font-size:17px;
            cursor: default;
        }   
        .rejcet-reason-style{
            margin:15px 0px;
            border:1px solid black;
            padding:10px;
            border-radius: 10px;
        }
        .rejcet-reason-style:hover{
            background-color: black;
            color:yellow;
            opacity: 0.8;
        }
    </style>
</head>
<body>
        <!-- main part on this file -->
        <div class="container container-style">
            <div class="card">

                <div class="card-header bg-danger">

                    <span class="fs-5"><span class="text-warning fs-3">My</span><span class="text-light">Technology</span></span>
                    <button class="btn btn-dark float-end">
                        <?= date("Y-m-d H:i:s") ?>
                    </button>

                </div>


                <div class="card-body">
                    
                <?php if(trim($rej_reason->reason_1) != "empty") : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * အမည် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_2) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * ဖုန်းနံပါတ် မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_3) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * email မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_4) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * နေရပ်လိပ်စာ မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_5) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * ငွေလွဲမှု မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_6) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * ရွေးချယ်ထားသော ငွေလွှဲမှုနည်းလမ်း နဲ့ ငွေလွှဲပုံ နှင့် ကိုက်ညီမှု ရှိ/မရှိ စစ်ဆေးပေးပါ။
                        </span>
                        
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->reason_7) != "empty")     : ?>               
                    <div class="rejcet-reason-style">
                        <span class="reject-style">
                                * အချက်အလတ်များ ကိုက်ညီမှု မရှိ သဖြင့် ထပ်မံ ဖြည့်စွတ်ပေးပါ။
                        </span>
                    </div>
                <?php endif ?>


                <?php if(trim($rej_reason->ad_reason) != "")     : ?>               
                    <div class="rejcet-reason-style">
                    <span class="mb-5">မှတ်ချက်</span>
                        <div class="reject-style">
                                * <?= $rej_reason->ad_reason ?>
                        </div>
                    </div>  
                <?php endif ?>



                <div class="card-footer">
                    <div class="row">
                            <div class="col-6">
                                <div class="my-1 fs-5"><?= $rej_reason->ad_name ?></div>
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
                <span>* ကျေးဇူးပြုရျ် နောက်တစ်ကြိမ် ထပ်မံ ကြိုးစားကြည့်ပါ။</span>
            </div>

        </div>
        <!-- message for notice -->

</body>
</html>