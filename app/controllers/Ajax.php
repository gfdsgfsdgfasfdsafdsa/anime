<?php
class Ajax extends Controller {
    public function __construct()
    {
        $this->a = $this->model('AjaxModel');
    }

    public function animeRequest(){
        $this->a->insertIntoRequest();
    }

    public function animeReport(){
        $this->a->insertIntoReport();
        //echo $_POST['animeName'] . ' ' . $_POST['episodeNumber'] . ' ' . $_POST['reason'];
    }
}