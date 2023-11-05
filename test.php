<?php
include("vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UserLoginSystem;

$database = new UserLoginSystem(new MySQL());
$data =[
    "id" =>1,
    "username" =>"admin",
    "email"=>  "admin@gmail.com",
    "password" => "admin123"
];
echo $database->mainAdminUpdate($data);

