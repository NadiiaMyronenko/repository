<?php

class ControllerMother extends ControllerBase {

    public function __construct()
    {
        session_start();
        $this->model = new ModelMother();
    }

    public function index(){
        header('Location: ' . DS . PROJECT_NAME . DS . 'mother'. DS. 'taskList');
    }

    public function tasklist(){
        $data = $this->model->getTaskForUser($_SESSION['id']);

        include_once ROOT.DS."view".DS. "mother.html";
    }

    public function done(){
        if(isset($_POST['done'])) {
            $this->model->updateStatusTask($_POST);
            header('Location: ' . DS . PROJECT_NAME . DS . 'mother'. DS. 'taskList');
        }
    }

    public function uploadFile()
    {
        if(is_uploaded_file($_FILES['filename']['tmp_name'])) {
            $path_info = pathinfo($_FILES['filename']['name']);
            if ($path_info['extension'] == 'txt') {
                $content = trim(file_get_contents($_FILES['filename']['tmp_name']));
                $tasks = explode(';', $content);

                $this->model->saveTask($tasks);

                $this->setFlashMessage('File uploaded successfully! Next step: the father must distribute tasks among family members.');
            }
            else {
                $this->setFlashMessage('Error file type');
            }
        }
        else $this->setFlashMessage('Error uploaded file. Please, try again.');
        header('Location: ' . DS . PROJECT_NAME . DS . 'mother'. DS. 'taskList');
    }

    public function setFlashMessage($message){
        $_SESSION['message'] = $message;
    }

    public function hasFlashMessage(){
        if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
            return true;
        }
        else return false;
    }

    public function getFlashMessage(){
        return $_SESSION['message'];
    }
}