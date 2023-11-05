<?php
include("../vendor/autoload.php");
use Libs\Database\MySQL;
use Helper\HTTP;
use Libs\Database\UserLoginSystem;

require("log/regular_exp_log.php");

// print_r($_POST);
session_start();
$ad_name = checkUser($_POST["admin_name"]) ? $_POST["admin_name"] : false;
$ad_email = checkEmail($_POST["admin_email"]) ? $_POST["admin_email"] : false;

$ad_password =   password($_POST["admin_password"]) ? $_POST["admin_password"] : false;
$ad_conpassword = password($_POST["admin_conpassword"]) ? $_POST["admin_conpassword"] : false;

$ad_data=[
    "username" => htmlspecialchars($_POST["admin_name"]),
    "email" => htmlspecialchars($_POST["admin_email"]),
    "password" => htmlspecialchars($_POST["admin_password"]),
    "conpassword" => htmlspecialchars($_POST["admin_conpassword"])
];

if(!$ad_name|| !$ad_email || !$ad_password || !$ad_conpassword){

    if(!$ad_name){
        $_SESSION["admin_name_wrong"] = "* write English and no special charactor";
    }

    if(!$ad_email){
        $_SESSION["admin_email_wrong"] = "* check your email again";
    }
    
    if(!$ad_password){
        $_SESSION["admin_pass_wrong"] = "* password should be between 6 and 15";
    }


    if($ad_password != $ad_conpassword){
        $_SESSION["ad_not_same_password"] = "* password not equal";
    }

    $_SESSION["admin_member_data"] = $ad_data;
    HTTP::redirect("/admin/mainAdminEdit.php");
}


 if(strlen(htmlspecialchars($_POST["password"])) == strlen($_POST["confirm-password"])){
    $data =[
        "id" => htmlspecialchars($_POST["id"]),
        "username" => htmlspecialchars($ad_name),
        "email"=>  htmlspecialchars($ad_email),
        "password" =>  htmlspecialchars($ad_conpassword)
    ];

    $database = new UserLoginSystem(new MySQL());
    $result = $database->mainAdminUpdate($data);

    if($result){
        $result = $database->findByEmailAndPassword($data["email"],$data["password"]);
        // print_r($result);
        $_SESSION["userInfo"] = $result;
        HTTP::redirect("/admin/mainAdminEdit.php");
    }
    
 }else{
    $_SESSION["ad_not_same_password"] = "* password not equal";
    $_SESSION["admin_member_data"] = $ad_data;
    HTTP::redirect("/admin/mainAdminEdit.php");   
 }


