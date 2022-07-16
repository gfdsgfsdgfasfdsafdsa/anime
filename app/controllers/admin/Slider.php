<?php
class Slider extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->sliderModel = $this->model('SliderModel');
    }

    public function index(){
        $data['sliderItems'] = $this->sliderModel->getAll();

        $load['current'] = 'slider';
        $this->view_page('admin/slider/index', $data, $load);
    }

    public function create(){
        if(count($this->sliderModel->getAll()) == 10){
            redirect('admin/slider', 'Cannot add anymore.', 'danger');
            return;
        }

        $data['animes'] = $this->sliderModel->getAllAnimeNotExistInSlider();

        if(Request::post()){
            $data['validation'] = $this->validator()->check([
                'bannerLink' => ['required' => true],
                'anime' => ['required' => true]
            ]);

            if(empty($_POST['anime']))
                $this->errorHandler->addError('Required');

            if($data['validation']->fails()){
                $load['current'] = 'sliderCreate';
                $this->view_page('admin/slider/create', $data, $load);
            }else{
                $this->sliderModel->insert();
                redirect('admin/slider/new', 'Anime has been added!', 'success');
            }

        }elseif (Request::get()){
            $load['current'] = 'sliderCreate';
            $this->view_page('admin/slider/create', $data, $load);
        }
    }

    public function delete(){
        $this->sliderModel->delete();
        redirect('admin/slider', 'Anime has been removed.', 'danger');
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'slider';
        $headerData['title'] = 'Admin | Slider';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }
}