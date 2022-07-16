<?php
class Episode extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->animeModel = $this->model('AnimeModel');
        $this->episodeModel = $this->model('EpisodeModel');
    }

    public function index(){
        $data['animes'] = $this->animeModel->getAll();

        //if ?anime=this_is_not_found then show 404
        if(isset($_GET['anime']) && !$this->animeModel->existsSlug($_GET['anime'])){
            $this->view('error404/index');
            die();
        }
        if(isset($_GET['anime']))
            $data['episodes'] = $this->episodeModel->getBySlug($_GET['anime']);

        $load['current'] = 'episodeIndex';
        $this->view_page('admin/episode/index', $data, $load);
    }

    public function create(){
        if(isset($_GET['anime']) && !$this->animeModel->existsSlug($_GET['anime'])){
            $this->view('error404/index');
            die();
        }

        if(Request::post()){
            $arr_count = 0;
            $data['validation'] = $this->validator()->check([]);
            if(empty($_POST['episodeLink']) || empty($_POST['episodeNumber'])){
                $this->errorHandler->addError('error');
            }else{
                //Check if all inputs are filled
                $arr_count = count($_POST['episodeLink']);
                for($i = 0; $i < $arr_count; $i++){
                    if(empty($_POST['episodeLink'][$i]) || empty($_POST['episodeNumber'][$i])){
                        $this->errorHandler->addError('error');
                        break;
                    }
                }
            }

            if($data['validation']->fails()){
                $load['current'] = 'episodeCreate';
                $this->view_page('admin/episode/create', $data, $load);
            }else{
                $this->episodeModel->insert();
                redirect('admin/episode?anime='.$_GET['anime'], 'New episode/s has been added', 'success');
            }

        }else if(Request::get()){
            $load['current'] = 'episodeCreate';
            $this->view_page('admin/episode/create', null, $load);
        }
    }

    public function update(){
        $data['episode'] = $this->episodeModel->get($_GET['id']);

        if(Request::post()){

            $data['validation'] = $this->validator()->check([
                'episodeLink' => ['required' => true],
                'episodeNumber' => ['required' => true]
            ]);

            if($data['validation']->fails()){
                $this->view_page('admin/episode/update', $data);
            }else{
                $this->episodeModel->update();
                redirect('admin/episode?anime='.$data['episode']->animeSlug, 'Episode has been successfully updated.', 'success');
            }

        }else if(Request::get()){
            $this->view_page('admin/episode/update', $data);
        }
    }

    public function deleteAll(){
        $this->episodeModel->deleteByAnimeSlug($_GET['anime']);
        redirect('admin/episode?anime='.$_GET['anime'], 'All episode/s has been deleted.', 'success');
    }

    public function delete(){
        $this->episodeModel->delete($_GET['id']);
        redirect('admin/episode?anime='.$_GET['anime'], 'Episode '.$_GET['episode'].' has been deleted.', 'success');
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'episode';
        $headerData['title'] = 'Admin | Episodes';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }
}