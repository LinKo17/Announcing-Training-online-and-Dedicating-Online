<?php
include("../vendor/autoload.php");

use Helper\Auth;
use Libs\Database\MySQL;
use Libs\Database\UserLoginSystem;

$database = new UserLoginSystem(new MySQL());
$db_data =  $database->takeSingleUserData(1);
// print_r($db_data);

session_start();
//checking user role in here
Auth::checkUserRole();
?>

<?php
if(isset($_SESSION["admin_member_data"])){
    $admin_member_Data = $_SESSION["admin_member_data"];
    // print_r($admin_member_Data);
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
    <script src="../bs/js/bootstrap.bundle.min.js" defer></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        #edit-container{
        width:400px;
        }

        @media(max-width:420px){
        #edit-container{
        width:325px;
        }
        }
    </style>
</head>
<body>
    <!-- register form -->
    <div class="container mt-3" id="edit-container">

      <div class="card">
      <div class="card-header bg-primary text-light text-center h5">Main Admin Edit</div>

      <div class="card-body">
        <form action="../_action/main_admin_edit_data.php" method="post">
            <div class="my-2">
                <input type="hidden" value="1" name="id" class="form-control">
            </div>

            <div class="my-2">
                <label for="admin_name" class="mb-1">Name</label>

                <!-- -------------------------------- -->
                <input type="text" class="form-control mt-1 <?php if(isset($_SESSION["admin_name_wrong"])): ?> is-invalid <?php endif ?>" name="admin_name" id="admin_name" placeholder="Admin Name" required value="<?= isset($admin_member_Data["username"]) ? $admin_member_Data["username"] : $db_data->username  ?>">

                <?php if(isset( $_SESSION["admin_name_wrong"])): ?>
                    <span class="text-danger"><?= isset( $_SESSION["admin_name_wrong"]) ?$_SESSION["admin_name_wrong"] : "" ?></span>
                <?php endif  ?>
                <!-- -------------------------------- -->                
            </div>

            <div class="my-2">
                    <label for="admin_email" class="mb-1">Email</label>

                <!-- ------------------------------- -->
                <input type="text" class="form-control mt-1 <?php if(isset($_SESSION["admin_email_wrong"])): ?> is-invalid <?php endif ?>" name="admin_email" id="admin_email" placeholder="Admin Email" required value="<?= isset($admin_member_Data["email"]) ? $admin_member_Data["email"] : $db_data->email ?>">

                <?php if(isset( $_SESSION["admin_email_wrong"])): ?>
                    <span class="text-danger"><?= isset( $_SESSION["admin_email_wrong"]) ? $_SESSION["admin_email_wrong"] : "" ?></span>
                <?php endif  ?>
                <!-- ------------------------------- -->                
            </div>

            <div class="my-2">
                <label for="admin_password" class="mb-1">Password</label>

                <!-- --------------------------------------- -->
                <input type="text" class="form-control mt-1 <?php if(isset($_SESSION["admin_pass_wrong"])): ?> is-invalid <?php endif ?>" name="admin_password" id="admin_password" placeholder="Admin Password" required value="<?=$admin_member_Data["password"] ?? "" ?>">

                <?php if(isset( $_SESSION["admin_pass_wrong"])): ?>
                <span class="text-danger"><?= isset( $_SESSION["admin_pass_wrong"]) ? $_SESSION["admin_pass_wrong"] : "" ?></span>
                <?php endif  ?>
                <!-- --------------------------------------- -->                
            </div>


            <div class="my-2">
                <label for="admin_conpassword" class="mb-1">Confirm Password</label>

                <!-- --------------------------------------- -->
                <input type="text" class="form-control mt-1 <?php if(isset($_SESSION["ad_not_same_password"])): ?> is-invalid <?php endif ?>" name="admin_conpassword" id="admin_conpassword" placeholder="Admin Confirm Password" required value="<?=$admin_member_Data["conpassword"] ?? "" ?>">

                <?php if(isset( $_SESSION["ad_not_same_password"])): ?>

                <span class="text-danger"><?= isset( $_SESSION["ad_not_same_password"]) ? $_SESSION["ad_not_same_password"] : "" ?></span>

                <?php endif  ?>
                <!-- --------------------------------------- -->
            </div>

            
          
          <div class="my-2">
            <input type="radio" style="opacity:0">
            <div class="float-end">
              <button type="reset" class="btn btn-danger">Reset</button>
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </div>

  
        </form>
      </div>  
    </div>

    <div class="container text-center my-1" id="edit-container"> 
        <span>
            <a href="adminpanel.php" class="text-danger">Back To Admin Panel</a>
        </span>
    </div>

    <!-- /register form -->
    
    <?php
        if(isset( $_SESSION["admin_member_data"])){
            unset($_SESSION["admin_member_data"]);
        }
        if(isset( $_SESSION["admin_name_wrong"])){
            unset($_SESSION["admin_name_wrong"]);
        }
        if(isset( $_SESSION["admin_email_wrong"])){
            unset($_SESSION["admin_email_wrong"]);
        }
        if(isset( $_SESSION["admin_pass_wrong"])){
            unset($_SESSION["admin_pass_wrong"]);
        }
        if(isset( $_SESSION["ad_not_same_password"])){
            unset($_SESSION["ad_not_same_password"]);
        }

    ?>
</body>
</html>