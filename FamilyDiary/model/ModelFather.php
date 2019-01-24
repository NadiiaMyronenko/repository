<?php

class ModelFather extends ModelBase {

    public function selectNotDistributeTask(){
        $result = mysqli_query($this->db, "SELECT taskList.id, taskList.task FROM (taskList INNER JOIN user_task ON  user_task.id_task = taskList.id) WHERE id_user IS NULL");
        $notDistributeTask = array();
        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $notDistributeTask[] = $row;
            }
        }
        return $notDistributeTask;
    }

    public function selectAllUsers(){
        $select = mysqli_query($this->db, "SELECT id, name FROM user");
        $usersArray = array();
        if($select->num_rows > 0) {
            while ($row = $select->fetch_assoc()) {
                $usersArray[] = $row;
            }
        }
        return $usersArray;
    }

    public function saveDistributeTask($data){
        foreach($data as $idTask=>$idUser){
            $update = mysqli_query($this->db, "UPDATE user_task SET id_user = '{$idUser}' WHERE id_task = '{$idTask}'");
        }
    }
}