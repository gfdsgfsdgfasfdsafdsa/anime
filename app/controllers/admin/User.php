<?php
class User extends Controller{
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->userModel = $this->model('UserModel');
    }

    public function index(){
        $data['users'] = $this->userModel->getAll();
        $load['current'] = 'userIndex';
        $this->view_page('admin/user/index', $data, $load);
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'user';
        $headerData['title'] = 'Admin | User';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }

    public function create(){
        if(Request::post()){

            $data['users'] = $this->userModel->getAll();

            $data['validation'] = $this->validator()->check([
                'username' => ['required' => true, 'unique' => 'users'],
                'password' => ['required' => true],
                'role' => ['required' => true],
                'confirm-password' => ['match' => 'password']
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/user/create', $data);
            }else{
                $this->userModel->insert();
                redirect('admin/user/new', 'New User Has Been Added!', 'success');
            }


        }else if(Request::get()){
            $this->view_page('admin/user/create');
        }
    }

    public function update(){
        $data['user'] = $this->userModel->get($_GET['id']);

        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'username' => ['required' => true],
                'password' => ['required' => true],
                'confirm-password' => ['match' => 'password'],
            ]);

            if(!$this->userModel->isUserNameUnique($data['user']->username, $_POST['username'])){
                $this->errorHandler->addError('Username ['.$_POST['username'].'] Already Exist!', 'username');
            }

            if($data['validation']->fails()){
                $this->view_page('admin/user/update', $data);
            }else{
                $this->userModel->update();
                redirect('admin/user', 'User Has Been Updated!', 'success');
            }

        }else if(Request::get()){
            $this->view_page('admin/user/update', $data);
        }
    }

    public function delete(){
        $this->userModel->delete();
        redirect('admin/user', 'User Has Been Deleted!', 'success');
    }


}
