<?php
class Type extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->typeModel = $this->model('TypeModel');
    }

    public function index(){
        $data['types'] = $this->typeModel->getAll();

        $load['current'] = 'typeIndex';
        $this->view_page('admin/type/index', $data, $load);
    }

    public function create(){
        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'typeName' => [
                    'required' => true,
                    'unique' => 'type'
                ]
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/type/create', $data);
            }else{
                $this->typeModel->insert();
                redirect('admin/type/new', 'New Type Has Been Added!', 'success');
            }


        }else if(Request::get()){
            $load['current'] = 'typeCreate';
            $this->view_page('admin/type/create', null , $load);
        }
    }

    public function update(){
        $data['type'] = $this->typeModel->get(htmlEncode($_GET['id']));

        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'typeName' => [
                    'required' => true,
                ]
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/type/update', $data);
            }else{
                $this->typeModel->update();
                redirect('admin/type', 'Type Has Been Updated!', 'success');
            }

        }else if(Request::get()){
            $load['current'] = 'typeUpdate';
            $this->view_page('admin/type/update', $data, $load);
        }
    }

    public function delete(){
        $this->typeModel->delete();

        $this->animeTypeModel = $this->model('AnimeTypeModel');
        $this->animeTypeModel->deleteByTypeId($_GET['id']);

        redirect('admin/type', 'Type Has Been Deleted!', 'success');
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'type';
        $headerData['title'] = 'Admin | Type';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }
}