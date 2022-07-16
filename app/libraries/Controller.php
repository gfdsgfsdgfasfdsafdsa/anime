<?php
class Controller{
    public function model($model){
        return new $model();
    }
    public function view($view, $data = null){
        if(file_exists(APPROOT.'/views/'.$view.'.php')){
            if(!empty($data)) extract($data);
            require_once APPROOT.'/views/'.$view.'.php';
        }else{
            die("View does not exists");
        }
    }
    public function validator(){
        $this->errorHandler = new ErrorHandler();
        return new Validator(Database::getInstance() , $this->errorHandler);
    }
}