<?php
class Genre extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->genreModel = $this->model('GenreModel');
    }

    public function index(){
        $data['genres'] = $this->genreModel->getAll();

        $load['current'] = 'genreIndex';
        $this->view_page('admin/genre/index', $data, $load);
    }

    public function create(){
        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'genreName' => [
                    'required' => true,
                    'unique' => 'genre'
                ]
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/genre/create', $data);
            }else{
                $this->genreModel->insert();
                redirect('admin/genre/new', 'New Genre Has Been Added!', 'success');
            }


        }else if(Request::get()){
            $this->view_page('admin/genre/create');
        }
    }

    public function update(){
        $data['genre'] = $this->genreModel->get(htmlEncode($_GET['id']));

        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'genreName' => [
                    'required' => true,
                ]
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/genre/update', $data);
            }else{
                $this->genreModel->update();
                redirect('admin/genre', 'Genre Has Been Updated!', 'success');
            }

        }else if(Request::get()){
            $this->view_page('admin/genre/update', $data);
        }
    }

    public function delete(){
        $this->genreModel->delete();

        $this->animeGenreModel = $this->model('AnimeGenreModel');
        $this->animeGenreModel->deleteByTypeId($_GET['id']);

        redirect('admin/genre', 'Genre Has Been Deleted!', 'success');
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'genre';
        $headerData['title'] = 'Admin | Genre';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }
}