<?php
class Login extends Controller{

    public function __construct()
    {
        if(Session::get('user')) redirect('admin/slider');
        $this->userModel = $this->model('UserModel');
    }

    public function index(){
        if(Request::post()){

            if(empty($_POST['username']) || empty($_POST['password'])){
                $data['errorMgs'] = 'Field cannot be empty.';
                $this->view('admin/login', $data);
            }else{
                if($this->userModel->loggedIn($_POST['username'], $_POST['password'])){
                    redirect('admin/slider');
                }else{
                    $data['errorMgs'] = 'Username/password cannot be empty.';
                    $this->view('admin/login', $data);
                }
            }

        }elseif (Request::get()){
            $this->view('admin/login');
        }
    }

    public function logout(){
        Session::remove('user');
        redirect('admin');
    }

//    public function check(){
//        if(empty($_POST['username']) || empty($_POST['password'])){
//            redirect('admin/sign-in', 'Field cannot be empty.', 'danger');
//        }else{
//            if($this->userModel->loggedIn($_POST['username'], $_POST['password'])){
//                redirect('admin/slider');
//            }else{
//                redirect('admin/sign-in', 'Username/password is incorrect.', 'danger');
//            }
//        }
//    }
}