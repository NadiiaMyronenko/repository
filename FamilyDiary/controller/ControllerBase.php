<?php

class ControllerBase {

    protected $model;

    public function __construct()
    {
        $this->model = new ModelBase();
    }

    public function index(){
        include_once ROOT.DS."view".DS."registration.html";

        if ($_POST){
            $this->model->addNewUser($_POST);
            if(isset($_SESSION['id'])) {
                header('Location: ' . DS . PROJECT_NAME . DS . $_SESSION['role']);
                exit;
            }
        }
    }

    public function signIn(){
        include_once ROOT.DS."view".DS."signIn.html";

        if($_POST){
            $this->model->signIn($_POST);

            if(isset($_SESSION['id'])) {
                header("Location: " . DS . PROJECT_NAME . DS . $_SESSION['role']);
                exit;
            }
        }
    }

    public function signOut(){
        $this->model->sessionDestroy();
        header('Location: ' . DS. PROJECT_NAME);
    }
}