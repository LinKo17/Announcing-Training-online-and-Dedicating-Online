<?php
namespace Libs\Database;

use PDO;

class StuRegisterForm{
    private $db;

    public function __construct(MySQL $mysql){
         $this->db = $mysql->connect();
    }


    public function insertStuData($data){
        $statement = $this->db->prepare("INSERT INTO class_registered_students (stu_name,stu_phone_number,stu_email,stu_address,stu_pay_system,stu_pay_photo,class_open_date, 	class_open_time,course,batch_id,teacher_name,course_fee,created_at,updated_at) VALUES (:stu_name,:stu_phone_number,:stu_email,:stu_address,:stu_pay_system,:stu_pay_photo,:class_open_date, 	:class_open_time,:course,:batch_id,:teacher_name,:course_fee,NOW(),NOW())");

        return $statement->execute($data);
    }

    public function takeAllData($id){

        $statement = $this->db->prepare("SELECT * FROM class_registered_students WHERE id=:id");
        $statement->execute([
            "id"=>$id
        ]);
        return $statement->fetch();

    }

    public function allData(){
        $statement = $this->db->prepare("SELECT * FROM class_registered_students");
        $statement->execute();
        return $statement->fetchAll();
    }

    // show confirm section

    public function changeShow($id,$show){
        $statement = $this->db->prepare("UPDATE class_registered_students SET `show`=:show,updated_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "show"=>$show
        ]);
    }


    public function adminVerification($id,$veri){
        $statement = $this->db->prepare("UPDATE class_registered_students SET ad_veri_code=:ad_veri_code,updated_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "ad_veri_code"=>$veri
        ]);
    }

    //this is working to get register member id
    public function register_menber_id($stu_name, $stu_email, $stu_address, $batch_id, $course, $pay){
        $statement = $this->db->prepare("SELECT * FROM class_registered_students WHERE stu_name = :stu_name AND stu_email = :stu_email AND stu_address = :stu_address AND batch_id = :batch_id AND course = :course AND course_fee = :course_fee ORDER BY id DESC");
        
         $statement->execute([
            "stu_name" => $stu_name,
            "stu_email" => $stu_email,
            "stu_address" => $stu_address,
            "batch_id" => $batch_id,
            "course" => $course,
            "course_fee" => $pay
        ]);

        return $statement->fetch();

    }

    public function reConfirmVerfi($id,$reveri){
        $statement= $this->db->prepare("UPDATE class_registered_students SET re_veri_code=:re_veri_code,updated_at=NOW() WHERE id=:id");
        return $statement->execute([
            "id" => $id,
            "re_veri_code" =>$reveri
        ]);
    }

    public function confirm($id,$date,$confirm,$ad_name){
        $statement = $this->db->prepare("UPDATE class_registered_students SET registered_date_time=:registered_date_time,registered_done=:registered_done,updated_at=Now(),ad_name=:ad_name WHERE id=:id");
        return $statement->execute([
            "id"=> $id,
            "registered_date_time" => $date,
            "registered_done"=>$confirm,
            "ad_name"=>$ad_name
        ]);
    }

    public function deleteRegister($id){
        $statement = $this->db->prepare("DELETE FROM class_registered_students WHERE id=:id");
        return $statement->execute([
            "id"=>$id
        ]);
    }

        // table join class_posts table and teachers table

    // join class_posts and courses table
    public function joinClassPostsAndCoursesAll(){
        $database = $this->db;
        $query = $database->prepare("SELECT class_posts.*,courses.course AS c_course,courses.fee As c_fee FROM class_posts LEFT JOIN courses ON class_posts.category_id = courses.id ");
        $query->execute();
        return $query->fetchAll();
    }
    
    public function updateOpenClose($id,$action){
        $statement = $this->db->prepare("UPDATE class_posts SET open_close=:open_close WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "open_close"=>$action 
        ]);
    }
    
    public function rejectReason($r1,$r2,$r3,$r4,$r5,$r6,$r7,$ar,$stu_id,$ad_name){
        $statement = $this->db->prepare("INSERT INTO reject_reasons (ad_name,reason_1,reason_2,reason_3,reason_4,reason_5,reason_6,reason_7,ad_reason,stu_id,created_at,updated_at ) VALUES (:ad_name,:reason_1,:reason_2,:reason_3,:reason_4,:reason_5,:reason_6,:reason_7,:ad_reason,:stu_id,Now(),Now())");

        return $statement->execute([
            "ad_name" => $ad_name,
            "reason_1" => $r1,
            "reason_2" => $r2,
            "reason_3" => $r3,
            "reason_4" => $r4,
            "reason_5" => $r5,
            "reason_6" => $r6,
            "reason_7" => $r7,
            "ad_reason" =>$ar,
            "stu_id"=> $stu_id
        ]);


    }

    public function rejectConfirm($id,$reject){
        $statement = $this->db->prepare("UPDATE class_registered_students SET `reject`=:reject,updated_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "reject"=>$reject
        ]);
    }
    
    public function rejectRefuse($id,$reject){
        $statement = $this->db->prepare("UPDATE class_registered_students SET `reject`=:reject,updated_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "reject"=>$reject
        ]);
    }

    public function rejectReasonTaker($stu_id){
        $statement = $this->db->prepare("SELECT * FROM reject_reasons  WHERE stu_id=:stu_id");
        $statement->execute([
            "stu_id"=>$stu_id
        ]);
        return $statement->fetch();
    }

    public function waitAndNotWait($id,$action){
        $statement = $this->db->prepare("UPDATE class_posts SET wait=:wait,update_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "wait"=>$action
        ]);
    }

    public function waitAndNotWaitAll($action){
        $statement = $this->db->prepare("UPDATE class_posts SET wait=:wait,update_at=Now()");
        return $statement->execute([
            "wait"=>$action
        ]);
    }

    public function waitAndNotWaitBtnChange($id,$action){
        $statement = $this->db->prepare("UPDATE wait_btn_not_wait_btns SET wait_not_wait=:wait_not_wait,created_at=Now(),updated_at=Now() WHERE id=:id");
        return $statement->execute([
            "id"=>$id,
            "wait_not_wait" =>$action
        ]);
    }

    public function takeWaitBtn($id){
        $statement = $this->db->prepare("SELECT * FROM wait_btn_not_wait_btns WHERE id=:id");
        $statement->execute([
            "id"=>$id
        ]);
        return $statement->fetch();
    }


    

}
