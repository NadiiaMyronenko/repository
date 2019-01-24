<?php

class ControllerFather extends ControllerBase {
    public function __construct()
    {
        session_start();
        $this->model = new ModelFather();
    }

    public function index(){
        //Получение нераспределенных заданий
        $notDistributeTask = $this->model->selectNotDistributeTask();
        if(!empty($notDistributeTask)){
            $data = $notDistributeTask;
            $users = $this->model->selectAllUsers();
            include_once ROOT . DS . "view" . DS . "father.html";
        }
        else {
            //header('Location: '. DS . PROJECT_NAME . DS . 'father'. DS. 'taskList');
        }
    }

    //Сохранить распределение заданий между членами семьи. ($_POST: idTask => idUser)
    public function distributeTask(){
        if($_POST) {
            $this->model->saveDistributeTask($_POST);
            header('Location: ' . DS . PROJECT_NAME . DS . 'father'. DS. 'taskList');
        }
    }

    public function tasklist() {
        $data = $this->model->getTaskForUser($_SESSION['id']);
        include_once ROOT.DS."view".DS. "child.html";
    }

    public function done(){
        if(isset($_POST['done'])) {
            $this->model->updateStatusTask($_POST);
            header('Location: ' . DS . PROJECT_NAME . DS . 'father'. DS. 'taskList');
        }
    }
}