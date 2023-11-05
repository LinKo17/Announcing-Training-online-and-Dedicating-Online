<?php
include("../../vendor/autoload.php");
use Libs\Database\MySQL;
use Libs\Database\StuRegisterForm;
use Helper\HTTP;

session_start();
if($_GET["rd"] != $_SESSION["checkRandomNumber"]){
    HTTP::redirect("/admin/request_register/confirmRegisters.php");
}

$reason_1 = isset($_POST["reason_1"]) ? $_POST["reason_1"] : "empty";
$reason_2 = isset($_POST["reason_2"]) ? $_POST["reason_2"] : "empty";
$reason_3 = isset($_POST["reason_3"]) ? $_POST["reason_3"] : "empty";
$reason_4 = isset($_POST["reason_4"]) ? $_POST["reason_4"] : "empty";
$reason_5 = isset($_POST["reason_5"]) ? $_POST["reason_5"] : "empty";
$reason_6 = isset($_POST["reason_6"]) ? $_POST["reason_6"] : "empty";
$reason_7 = isset($_POST["reason_7"]) ? $_POST["reason_7"] : "empty";
$reason   = isset($_POST["notice"]) ? $_POST["notice"] : "empty";
$ad_name  = isset($_POST["admin_name"]) ? $_POST["admin_name"] : "empty";

$checkingReason = htmlspecialchars($reason);

$stu_id= $_GET["id"];
$rd =$_GET["rd"];

if($reason_1 == "empty" && $reason_2 == "empty" && $reason_3 == "empty" && $reason_4 == "empty" && $reason_5 == "empty" && $reason_6 == "empty" && $reason_7 == "empty" && strlen($reason) == 0){
    HTTP::redirect("/admin/request_register/rejectForm.php","id=$stu_id&&rd=$rd");
}

$database = new StuRegisterForm(new MySQL());
$result = $database->rejectReason($reason_1,$reason_2,$reason_3,$reason_4,$reason_5,$reason_6,$reason_7,$checkingReason,$stu_id,$ad_name);

if($result){
    $database->rejectConfirm($stu_id,1);
    HTTP::redirect("/admin/request_register/adminRequestRegister.php");
}else{
    HTTP::redirect("/admin/request_register/adminRequestRegister.php");
}


