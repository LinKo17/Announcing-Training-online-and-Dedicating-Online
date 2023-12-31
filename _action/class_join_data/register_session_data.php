<?php
//take data from class database
include("../../vendor/autoload.php");
include("reg_expression.php");

use Libs\Database\MySQL;
use Libs\Database\UsersAnotherTable;
use Helper\HTTP;
use Helper\Auth;

// user information detail
$stu_name = checkUser($_POST["name"]) ? $_POST["name"] : false ;
$stu_phone =  phone($_POST["ph_num"]) ? $_POST["ph_num"] : false;
$stu_email =  checkEmail($_POST["email"]) ? $_POST["email"] : false;
$stu_address = $_POST["address"];
$stu_pay_system = $_POST["pay_system"];

$reg_data = [
    "stu_name" => htmlspecialchars($_POST["name"]),
    "stu_phone_number" => htmlspecialchars($_POST["ph_num"]),
    "stu_email"=>htmlspecialchars($_POST["email"]),
    "stu_address"=> htmlspecialchars($stu_address),
    "stu_pay_system"=> htmlspecialchars($stu_pay_system),
    "stu_pay_photo" => htmlspecialchars($stu_pay_photo_name),
];

// user join clas information
session_start();
$class_id = $_POST["class_id"];
$random = Auth::randomNumber();
$ds = $_POST["ds"];

//regular expression
if(!$stu_name || !$stu_phone || !$stu_email){

    if(!$stu_name){
        $_SESSION["name_wrong"] = "* write English and no special charactor";
    }

    if(!$stu_phone){
        $_SESSION["phone_wrong"] = "* write English and no words";
    }
    
    if(!$stu_email){
        $_SESSION["email_wrong"] = "* check your gamil";
    }
    $_SESSION["register_member_data"] = $reg_data;
    HTTP::redirect("/class_join/register_form.php","id=$class_id&&rd=$random&&ds=$ds");
}






if(trim($ds) == "ho"){
    echo "fine";
}elseif(trim($ds) == "all"){
    echo "fine";
}else{
    HTTP::redirect("/index.php");
}

// user photo information detail
echo $stu_pay_photo_type = $_FILES["pay_photo"]["type"];

if( $stu_pay_photo_type == "image/jpg" ||  $stu_pay_photo_type == "image/jpeg"){
    $stu_pay_photo_name =  time() .$_FILES["pay_photo"]["name"];
    $stu_pay_photo_tmp_name = $_FILES["pay_photo"]["tmp_name"];
}else{
    $_SESSION["checkPhoto"] = " ဓာတ်ပုံသည် .jpg နဲ့သာ ဆုံးသောပုံဖြစ်ရမည်။";
    HTTP::redirect("/class_join/register_form.php","id=$class_id&&rd=$random");
}



//current time
$currentTime = date("Y-m-d H:i:s");


//this is class id / class time / course
$database = new UsersAnotherTable(new MySQL());
$resultICC = $database->joinClassPostsAndCourses($class_id);

$class_date = $resultICC[0]->class_date;
$class_time = $resultICC[0]->class_time;
$class_course = $resultICC[0]->c_course;
$class_teacher_id = $resultICC[0]->teacher_id;



//this is teacher and courses fee
$resultTF = $database->joinTeachersAndCourses($class_teacher_id);
$teacher_name = $resultTF[0]->teacher_name;
$course_fee = $resultTF[0]->c_fee;

if(!isset($stu_name) || !isset($stu_phone) || !isset($stu_email) || !isset($stu_address) || !isset($stu_pay_system) || !isset($class_id)){
    # အပေါ်က တစ်ခုခု true ထွကိရင် ဒီထဲဝင်လာလိမ့်မယ်။
    # မရှိတာ ဟုတ်တယ်ဆိုရင် ဒီထဲဝင်လာလိမ့်မယ်။
    $random = Auth::randomNumber();
    HTTP::redirect("/class_join_data/register_form.php","id=$class_id&&rd=$random&&ds=$ds");
}

$data =[
    "stu_name" => htmlspecialchars($stu_name),
    "stu_phone_number" => htmlspecialchars($stu_phone),
    "stu_email"=>htmlspecialchars($stu_email),
    "stu_address"=> htmlspecialchars($stu_address),
    "stu_pay_system"=> htmlspecialchars($stu_pay_system),
    "stu_pay_photo" => htmlspecialchars($stu_pay_photo_name),
    "class_open_date" => htmlspecialchars($class_date),
    "class_open_time"=> htmlspecialchars($class_time),
    "course" => htmlspecialchars($class_course),
    "batch_id"=> htmlspecialchars($class_id),
    "teacher_name" => htmlspecialchars($teacher_name),
    "course_fee"=> htmlspecialchars($course_fee),
];


     move_uploaded_file("$stu_pay_photo_tmp_name","../../user_pay_photo/$stu_pay_photo_name");

    // main part or this project
        $_SESSION["register_member_data"] = $data;
        $_SESSION["button__press"] = true;
    // main part or this project

     HTTP::redirect("/class_join/register_form_data_show.php","id=$class_id&&rd=$random&&ds=$ds");


