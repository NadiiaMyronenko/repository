<?php

class ModelMother extends ModelBase {

    //Добавить задания в таблицу taskList
    public function saveTask($tasks){
        mysqli_query($this->db, 'DELETE FROM taskList');
        foreach ($tasks as $task){
            if(!empty($task)) {
                mysqli_query($this->db, "INSERT INTO taskList SET task = '{$task}', status = 0");
            }
        }
        $this->insertIdTaskInUser_task();
    }

    //Добавить задания в таблицу user_task
    public function insertIdTaskInUser_task(){
        //mysqli_query($this->db, 'DELETE FROM user_task');
        $result = mysqli_query($this->db, 'SELECT id FROM taskList');
        while ($row = $result->fetch_assoc()){
            $id = $row['id'];
            mysqli_query($this->db, "INSERT INTO user_task SET id_task = '{$id}'");
        }
    }
}