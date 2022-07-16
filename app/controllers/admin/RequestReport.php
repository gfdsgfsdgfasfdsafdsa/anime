<?php
class RequestReport extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }
        $this->r = $this->model('RequestReportModel');
    }
    /* Request Section */
    public function request(){
        $data['request'] = $this->r->getAllRequest();

        $load['current'] = 'request';
        $this->view_page('admin/request', $data, $load);
    }

    public function deleteRequest(){
        if(isset($_GET['id'])){
            $this->r->deleteRequest();
            redirect('admin/request', 'Request has been deleted.', 'success');
        }else{
            $this->r->deleteAllRequest();
            redirect('admin/request', 'All status that are done has been deleted.', 'success');
        }
    }

    public function markAsDone(){
        $this->r->markAsDoneRequest();
        redirect('admin/request', 'The anime has been marked as done.', 'success');
    }

    /* Report */
    public function report(){
        $data['report'] = $this->r->getAllReport();

        $load['current'] = 'report';
        $this->view_page('admin/report', $data, $load);
    }

    public function deleteSelected(){
        if(isset($_POST['ids']) && !empty($_POST['ids'])){
            foreach ($_POST['ids'] as $id){
                $this->r->deleteSelectedReport($id);
            }
            redirect('admin/report', 'Report has been delete.', 'success');
        }else{
            redirect('admin/report', 'Please check at least 1.', 'danger');
        }

    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'requestReport';
        $headerData['title'] = 'Admin | Request/Report';

        $headerData['request'] = $this->r->getAllUnreadRequestCount();
        $headerData['report'] = $this->r->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);

        if($page == 'admin/request'){
            $this->r->updateReadRequest();
        }else if($page == 'admin/report'){
            $this->r->updateReadReport();
        }


    }
}