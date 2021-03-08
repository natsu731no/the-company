<?php
require_once "database.php";

class User extends Database{
    public function login($username, $password){
        $sql = "SELECT id, username, `password` FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        //num_rows → sqlの行数を返す
        if($result->num_rows == 1){
            $user_detailes = $result->fetch_assoc();
            
            //password_verify → ハッシュ化されたパスワード同士で突き合わせをする
            if(password_verify($password, $user_detailes['password'])){

                session_start();

                $_SESSION['user_id'] = $user_detailes['id'];
                $_SESSION['username'] = $user_detailes['username'];

                header("location: ../views/dashboard.php");

            }else{
                echo "The username or password you entered is incprrect ";
            }

        }else{
            echo "The username or password you entered is incprrect ";
        }
    }


    public function createUser($first_name, $last_name, $username, $password, $origin){
        $sql ="INSERT INTO users(first_name, last_name, username, `password`) 
                VALUES ('$first_name', '$last_name', '$username', '$password')";

        if($this->conn->query($sql)){
            if($origin == "register"){
                header("location: ../views/index.php"); //go to index.php /login page
                exit;
            }elseif($origin == "dashboard"){
                header("location: ../views/dashboard.php");
                exit;
            }
            

        }else{
            die("Error creating user : " .$this->conn->error);
        }
    }

    public function getUsers(){
        $sql ="SELECT id, first_name, last_name, username FROM users";

        if($result = $this->conn->query($sql)){
            return $result;

        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    }

    public function getUser($user_id){
        $sql ="SELECT id, first_name, last_name, username FROM users WHERE id = $user_id";
        
        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();

            //Use fetch_assoc() since we're expecting I row only
            //return on associative array

        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    }

    public function updateUser($user_id, $first_name, $last_name, $username){
        $sql = "UPDATE users SET first_name  = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $user_id ";
    
        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    
    
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM users WHERE id = $user_id";

        if($this->conn->query($sql)){
            header("location: ../views/dashboard.php");
            exit;
        }else{
            die("Error retrieving users" . $this->conn->error);
        }
    }

}

