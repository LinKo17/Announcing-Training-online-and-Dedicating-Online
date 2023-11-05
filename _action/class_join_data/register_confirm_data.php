<?php 
include("../../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\StuRegisterForm;
use Helper\Auth;
use Helper\HTTP;

//current time
$currentTime = date("Y-m-d H:i:s");
session_start();
$ad_name = isset($_SESSION["userInfo"]) ? $_SESSION["userInfo"]->username : "empty";

$database = new StuRegisterForm(new MySQL());
$result = $database->confirm($_GET["id"],$currentTime,"done",$ad_name);
$database->changeShow($_GET["id"],3);

session_start();
$random = Auth::randomNumber();
$path_id = $_GET['id'];

if($result){
    HTTP::redirect("/admin/request_register/adminConfirmDetail.php","id=$path_id&&rd=$random");
}else{
    HTTP::redirect("/admin/request_register/adminConfirmDetail.php","id=$path_id&&rd=$random");

}