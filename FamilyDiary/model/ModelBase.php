<?php

class ModelBase {
    public $db;

    public function __construct()
    {
        $this->db = new mysqli(HOST, USER, PASSWORD, DB_NAME);
        if($this->db->errno){
            exit('Could not connect to database!');
        }
    }

    public function addNewUser($data){
        if(empty($data['name']) || empty($data['password'])){
            exit('Not name or email');
        }
        $name = trim(htmlspecialchars(stripcslashes($data['name'])));
        $password = md5(trim(htmlspecialchars(stripcslashes($data['password']))));
        $role = $data['role'];

        //Проверка на существование пользователя с таким же именем
        $selectId = mysqli_query($this->db, "SELECT id FROM user WHERE name = '{$name}'");
        if($selectId->num_rows > 0){
            exit("Name $name is already isset in DB");
        }

        $insert = mysqli_query($this->db, "INSERT INTO user SET name = '{$name}', password = '{$password}', role = '{$role}'");
        if($insert == false){
            exit('User does not add' . $this->db->error);
        }

        //Получение id и роли зарегестрированного пользователя
        $selectIdRole = mysqli_query($this->db, "SELECT id, role FROM user WHERE name = '{$name}' AND password = '{$password}'");
        if($selectIdRole->num_rows > 0) {
            $userdata = $selectIdRole->fetch_assoc();
        }
        else {
            exit('Error' . $this->db->error);
        }

        $this->sessionStart($userdata);
    }

    public function signIn($data){
        if(empty($data['name']) || empty($data['password'])){
            exit('Not name or email');
        }

        $name = trim(htmlspecialchars(stripcslashes($data['name'])));
        $password = md5(trim(htmlspecialchars(stripcslashes($data['password']))));

        $selectIdRole = mysqli_query($this->db, "SELECT id, role FROM user WHERE name = '{$name}' AND password = '{$password}'");
        if($selectIdRole->num_rows > 0) {
            $userdata = $selectIdRole->fetch_assoc();
        }
        else {
            exit("Incorrect name or password");
        }

        $this->sessionStart($userdata);
    }

    public function sessionStart($userdata){
        session_start();
            $_SESSION['id'] = $userdata['id'];
            $_SESSION['role'] = $userdata['role'];
            $_SESSION['message'] = '';
    }

    public function sessionDestroy(){
        session_start();
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        unset($_SESSION['message']);
        session_destroy();
    }

    public function getTaskForUser($id){
        $select = mysqli_query($this->db, "SELECT * FROM (taskList INNER JOIN (user INNER JOIN user_task ON user_task.id_user = user.id) ON user_task.id_task = taskList.id) WHERE id_user = '{$id}' AND status = 0");

        $taskArray = array();
        if($select->num_rows > 0) {
            while($row = $select->fetch_assoc()){
                $taskArray[] = $row;
            }
        }

        return $taskArray;
    }

    public function updateStatusTask($data){
        if(empty($data['id_task'])){
            exit("Empty id_task: " . $data['id_task']);
        }
        $idTask = $data['id_task'];
        $update = mysqli_query($this->db, "UPDATE taskList SET status = 1 WHERE id = '{$idTask}'");
        if($update == false){
            exit('Error updating records: ' . $this->db->error);
        }
    }
}