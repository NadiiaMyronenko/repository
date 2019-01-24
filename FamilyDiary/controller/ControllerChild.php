<?php

class ControllerChild extends ControllerBase {

    public function __construct()
    {
        session_start();
        $this->model = new ModelChild();
    }

    public function index(){
        header('Location: ' . DS . PROJECT_NAME . DS . 'child'. DS. 'taskList');
    }

    public function tasklist(){
        $data = $this->model->getTaskForUser($_SESSION['id']);
        include_once ROOT . DS . "view" . DS . "child.html";
    }

    public function done(){
        if(isset($_POST['done'])) {
            $this->model->updateStatusTask($_POST);
            header('Location: ' . DS . PROJECT_NAME . DS . 'child'. DS. 'taskList');
        }
    }
}