<?php
namespace Libs\Database;

class UserLoginSystem{
    private $db;

    public function __construct(MySQL $mysql){
         $this->db = $mysql->connect();
    }
    
    public $test = "helo";

    // sign up function
    // public function insertUserdata($data){
    //     $database = $this->db;
    //     $query = $database->prepare("INSERT INTO user_login (username,email,password,created_at) VALUES (:username,:email,:password,Now())");

    //     $data["password"] = password_hash($data['password'],PASSWORD_DEFAULT);
    //     return $query->execute($data);
        
    // }

public function insertUserdata($data) {
    // Check if the email already exists
    $statement = $this->db->prepare("SELECT email FROM user_login WHERE email = :email");
    $statement->execute([
        "email" => $data["email"]
    ]);
    $existingEmail = $statement->fetchColumn();

    if ($existingEmail !== false) {
        return false; // Email already exists
    }

    // Prepare and execute the INSERT statement
    $query = $this->db->prepare("INSERT INTO user_login (username, email, password, created_at) VALUES (:username, :email, :password, NOW())");

    // Hash the password
    $data["password"] = password_hash($data['password'], PASSWORD_DEFAULT);

    return $query->execute($data);
}



    

    // sign in function
    public function findByEmailAndPassword($email,$password){
        $statement = $this->db->prepare("SELECT * FROM user_login WHERE email=:email");
        $statement->execute(["email"=>$email]);

        $user = $statement->fetch();
        if(password_verify($password,$user->password)){
            return $user;
        }

        return false;

        //new
    }

    public function takeAllUserData(){
        $statement = $this->db->prepare("SELECT * FROM user_login");
        $statement->execute();
        return $statement->fetchAll();
    }

    // user management system method

    public function  userCheck($id,$done){
        $statement = $this->db->prepare("UPDATE user_login SET ban=:done WHERE id=:id");
        $statement->execute([
            "id" => $id,
            "done" => $done
        ]);

    }

    public function deleteUser($id){
        $statement = $this->db->prepare("DELETE FROM user_login WHERE id=:id");
        return $statement->execute([
            "id"=>$id
        ]);
    }

    public function changeRole($id,$role_id){
        $statement = $this->db->prepare("UPDATE user_login SET role_id=:role_id WHERE id=:id");
        $statement->execute([
            "id"=>$id,
            "role_id"=>$role_id
        ]);
    }

    // join user_login->role_id && roles->id in this section

    public function userRoleIdAndRolesId(){
        $statement = $this->db->prepare("SELECT user_login.*,roles.role AS r_role_id FROM user_login LEFT  JOIN roles ON user_login.role_id = roles.id");
        $statement->execute();
        return $statement->fetchAll();
    }

    public function takeSingleUserData($id){
        $statement = $this->db->prepare("SELECT * FROM user_login WHERE id=:id");
        $statement->execute([
            "id"=>$id
        ]);
        return $statement->fetch();

    }

    public function mainAdminUpdate($data){
        $statement = $this->db->prepare("UPDATE user_login SET username=:username,email=:email,password=:password,updated_at=Now() WHERE id=:id");
        $data["password"] = password_hash($data['password'],PASSWORD_DEFAULT);
        return $statement->execute($data);
    }

}
