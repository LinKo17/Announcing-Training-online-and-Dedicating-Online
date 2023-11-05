<?php
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\UserLoginSystem;
use Helper\Auth;
session_start();
$random = Auth::randomNumber();

//checking user role in here
Auth::checkUserRole();

$database = new UserLoginSystem(new MySQL());
$allUsersData = $database-> userRoleIdAndRolesId();
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
        @media(max-width:780px){
            .hide-action-style{
                display: none;
            }
        }
        @media(max-width:519px){
            .hide-email-style{
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- navbar section -->
<?php require_once("adminNavbar.php"); ?>
<!-- navbar section -->

<!-- user information -->
<div class="container mt-2">
    <table class="table text-center table-bordered table-hover table-dark table-striped">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th class="hide-email-style">Email</th>
            <th >Role</th>
            <th class="hide-action-style">Action</th>
        </tr>

        <?php foreach($allUsersData as $item): ?>
        <tr>
            <td><?= $item->id ?></td>
            <td><?= $item->username ?></td>
            <td class="hide-email-style"><?= $item->email ?></td>

            <td >

                <?php if($item->role_id == 1) : ?>

                <span class="badge bg-secondary">
                        <?= $item->r_role_id ?>              
                    </span>

                <?php elseif($item->role_id == 3): ?>

                    <span class="badge bg-success">
                        <?= $item->r_role_id ?>              
                    </span>

                <?php elseif($item->role_id == 4) : ?>

                    <span class="badge bg-info">
                        <?= $item->r_role_id ?>              
                </span>

                <?php elseif($item->role_id == 5): ?>

                    <span class="badge bg-primary">
                        <?= $item->r_role_id ?>              
                    </span>

                <?php endif ?>
            </td>

            <td class="hide-action-style">
                <?php if($item->id != 1): ?>

                    <div class="btn-group">
                        <button class="btn btn-outline-light dropdown btn-sm">
                            <span class="dropdown-toggle" data-bs-toggle="dropdown">Role</span>

                            <div class="dropdown-menu">
                                <a href="../_action//usermanagement/role_change.php?role=1&id=<?= $item->id ?>&rd=<?=$random?>" class="dropdown-item text-center">User</a>

                                <a  href="../_action//usermanagement/role_change.php?role=3&id=<?= $item->id ?>&rd=<?=$random?>" class="dropdown-item text-center">Teacher</a>

                                <a  href="../_action//usermanagement/role_change.php?role=4&id=<?= $item->id ?>&rd=<?=$random?>" class="dropdown-item text-center">Admin</a>

                                <a  href="../_action//usermanagement/role_change.php?role=5&id=<?= $item->id ?>&rd=<?=$random?>" class="dropdown-item text-center">Manager</a>
                            </div>
                        </button>

                        <?php if($item->ban == 1) :?>
                            <a href="../_action/usermanagement/unban.php?id=<?=$item->id?>&rd=<?=$random?>" class="btn btn-outline-warning btn-sm">Banned</a>
                            <?php else : ?>
                            <a href="../_action/usermanagement/ban.php?id=<?=$item->id?>&rd=<?= $random ?>" class="btn btn-outline-success btn-sm">Active</a>
                        <?php endif ?>

                        
                        <a href="../_action/usermanagement/delete_User.php?id=<?= $item->id ?>&rd=<?= $random?>"  class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>

                <?php endif ?>

                <?php if($item->id == 1): ?>
                    <a href="mainAdminEdit.php" class="btn btn-outline-warning btn-sm">Edit Admin</a>
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</div>
<!-- /user information -->



</body>
</html>