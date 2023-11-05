<?php
include("../../vendor/autoload.php");
use Helper\HTTP;


session_start();
if($_GET["rd"] != $_SESSION["checkRandomNumber"]){
    HTTP::redirect("/admin/request_register/confirmRegisters.php");
}


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
        .main-style{
            border:1px dotted red;
            padding:10px 0px;
            border-radius: 20px;
        }
        .textarea-style{
            border:1px dotted red;
            border-radius: 20px;
        }
        .textarea-style::placeholder{
            color:red;
        }
        .container-style{
            width:500px;
            user-select: none;
        }
        @media(max-width:501px){
            .container-style{
                width:375px;
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

<!-- main section     -->
<form action="../../_action/class_join_data/reject_action.php?id=<?=$_GET["id"]?>&&rd=<?=$_GET["rd"]?>" method="post">
    <div class="container container-style mt-3">
        <div class="card">
            <div class="card-header bg-danger text-center text-light h5"> Rejection Reason</div>
    
            <div class="card-body">
                <div class="my-2">
                    <input type="hidden" class="form-control" name="admin_name" value="<?= isset($_SESSION["userInfo"]) ? $_SESSION["userInfo"]->username : "" ?>">
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_1" name="reason_1" value="reason_1">
                    </div>
                    <label for="reason_1" class="col-md-10 col-11 text-danger  text-style">
                        * အမည် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                    </label>
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_2" name="reason_2" value="reason_2">
                    </div>
                    <label for="reason_2" class="col-md-10 col-12 text-danger text-style">
                        * ဖုန်းနံပါတ် မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                    </label>
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_3" name="reason_3" value="reason_3">
                    </div>
                    <label for="reason_3" class="col-md-10 col-12 text-danger text-style">
                        * email မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                    </label>
                </div>
                
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_4" name="reason_4" value="reason_4">
                    </div>
                    <label for="reason_4" class="col-md-10 col-12 text-danger text-style">
                        * နေရပ်လိပ်စာ မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                    </label>
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_5" name="reason_5" value="reason_5">
                    </div>
                    <label for="reason_5" class="col-md-10 col-12 text-danger text-style">
                        * ငွေလွဲမှု မှန်/မမှန် ကို ပြန်လည် စစ်ဆေးပေးပါ။
                    </label>
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_6" name="reason_6" value="reason_6">
                    </div>
                    <label for="reason_6" class="col-md-10 col-12 text-danger text-style">
                        * ရွေးချယ်ထားသော ငွေလွှဲမှုနည်းလမ်း နဲ့ ငွေလွှဲပုံ နှင့် ကိုက်ညီမှု မရှိပါ။
                    </label>
                </div>
    
                <div class="row my-0 main-style">
                    <div class="col-1 check-style">
                        <input type="checkbox" id="reason_7" name="reason_7" value="reason_7">
                    </div>
                    <label for="reason_7" class="col-md-10 col-12 text-danger text-style">
                        * အချက်အလတ်များ ကိုက်ညီမှု မရှိ သဖြင့် ထပ်မံ ဖြည့်စွတ်ပေးပါ။
                    </label>
                </div>
    
            </div>
        </div>
    </div>
    
    <div class="container container-style">
        <div class="mt-2">
            <textarea  class="form-control textarea-style" placeholder="မှတ်ချက်များ"name="notice" ></textarea>
        </div>
    </div>

    <div class="text-center mt-2">
        <a href="../../admin/request_register/adminRequestRegister.php" class="btn btn-secondary">Back</a>
        <button  type="submit" class="btn btn-danger">Reject</button>
    </div>

</form>
<!-- main section     -->

</body>
</html>