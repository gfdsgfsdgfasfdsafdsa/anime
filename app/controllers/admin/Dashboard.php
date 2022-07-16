<?php
class Dashboard extends Controller {

    public function index(){
        $this->view_page('admin/dashboard/index');
    }

    public function view_page($page, $data = null){
        $headerData['navActive'] = 'dashboard';

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer');
    }
}