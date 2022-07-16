<?php
class Anime extends Controller {
    public function __construct()
    {
        if(!Session::get('user')){
            redirect('admin/sign-in');
            Session::set('m', 'Please login first.');
        }

        $this->genreModel = $this->model('GenreModel');
        $this->typeModel = $this->model('TypeModel');
        $this->animeModel = $this->model('AnimeModel');
        $this->animeTypeModel = $this->model('AnimeTypeModel');
        $this->animeGenreModel = $this->model('AnimeGenreModel');
        $this->episodeModel = $this->model('EpisodeModel');
    }

    public function checkUrlSlug(){
        //Safe check if url slug exist in database
        //Eg. anime/update?anime=this-is-anime
        if(!isset($_GET['anime']) || !$this->animeModel->existsSlug($_GET['anime'])){
            $this->view('error404/index');
            die();
        }
    }

    public function index(){
        $data['animes'] = $this->animeModel->getAll();

        $data['animeTypes'] = $this->animeTypeModel->getAllTypeTextFormat();
        $data['animeGenres'] = $this->animeGenreModel->getAllGenreTextFormat();

        $load['current'] = 'animeIndex';
        $this->view_page('admin/anime/index', $data, $load);
    }

    public function view_(){
        $this->checkUrlSlug();

        $data['animeTypes'] = $this->animeTypeModel->getAllTypeTextFormat();
        $data['animeGenres'] = $this->animeGenreModel->getAllGenreTextFormat();

        $data['anime'] = $this->animeModel->getAnimeBySlug($_GET['anime']);

        $load['current'] = 'animeView';
        $this->view_page('admin/anime/view', $data, $load);
    }

    public function create(){
        $data['genres'] = $this->genreModel->getAll();
        $data['types'] = $this->typeModel->getAll();

        if(Request::post()){
            $data['validation'] = $this->validator()->check([
                'title' => ['uniqueSlug' => 'anime', 'required' => true],
                'slug' => ['unique' => 'anime'],
                'status' => ['required' => true],
                'posterLink' => ['required' => true],
                'dateFrom' => ['required' => true],
                'storySypnosis' => ['required' => true],
                'titleKeywords' => ['required' => true]
            ]);
            if(!isset($_POST['genreIds']) || !isset($_POST['typeIds']))
                $this->errorHandler->addError('Required!.');

            if($data['validation']->fails()){
                $load['current'] = 'animeCreate';
                $this->view_page('admin/anime/create', $data, $load);
            }else{
                //insert anime
                $this->animeModel->insert();

                $animeSlug = $this->animeModel->getSlugLastInserted();
                //insert genres
                $this->animeGenreModel->insert($animeSlug, $_POST['genreIds']);
                //insert types
                $this->animeTypeModel->insert($animeSlug, $_POST['typeIds']);
                redirect('admin/anime/new', 'New Anime Has Been Added!', 'success');
            }

        }else if(Request::get()){
            $load['current'] = 'animeCreate';
            $this->view_page('admin/anime/create', $data, $load);
        }
    }

    public function update(){
        $this->checkUrlSlug();

        $data['genres'] = $this->genreModel->getAll();
        $data['types'] = $this->typeModel->getAll();
        $data['anime'] = $this->animeModel->getAnimeBySlug($_GET['anime']);
        //Get anime genre,type ids by array
        $data['genreSelectedIds'] = $this->animeGenreModel->getByAnimeSlug($_GET['anime']);
        $data['typeSelectedIds'] = $this->animeTypeModel->getByAnimeSlug($_GET['anime']);

        if(Request::post()){
            $data['validation'] = $this->validator()->check([
                'title' => ['required' => true],
                'status' => ['required' => true],
                'posterLink' => ['required' => true],
                'dateFrom' => ['required' => true],
                'storySypnosis' => ['required' => true],
                'titleKeywords' => ['required' => true]
            ]);
            if(!isset($_POST['genreIds']) || !isset($_POST['typeIds']))
                $this->errorHandler->addError('Required!.');

            //Check unique except the current value
            if($this->animeModel->slugExistExcept(generateSlug($_POST['title']), $_GET['anime']))
                $this->errorHandler->addError('slugExist', 'title');

            if($data['validation']->fails()){
                $load['current'] = 'animeCreate';
                $this->view_page('admin/anime/update', $data, $load);
            }else{
                $this->animeModel->update();

                //delete types and genres
                $this->animeGenreModel->deleteByAnimeSlug($_GET['anime']);
                $this->animeTypeModel->deleteByAnimeSlug($_GET['anime']);
                //and insert
                $this->animeGenreModel->insert(generateSlug($_POST['title']), $_POST['genreIds']);
                $this->animeTypeModel->insert(generateSlug($_POST['title']), $_POST['typeIds']);
                redirect('admin/anime', 'Anime Has Been Updated!', 'success');
            }

        }else if(Request::get()){
            $load['current'] = 'animeCreate';
            $this->view_page('admin/anime/update', $data, $load);
        }
    }

    public function delete(){
        $this->checkUrlSlug();

        $this->animeModel->delete();
        $this->animeGenreModel->deleteByAnimeSlug($_GET['anime']);
        $this->animeTypeModel->deleteByAnimeSlug($_GET['anime']);
        $this->episodeModel->deleteByAnimeSlug($_GET['anime']);
        redirect('admin/anime', readableSlug($_GET['anime']).' Has Been Deleted!', 'success');
    }

    public function view_page($page, $data = null, $load = null){
        $headerData['navActive'] = 'anime';
        $headerData['title'] = 'Admin | Anime';

        $this->request = $this->model('RequestReportModel');
        $headerData['request'] = $this->request->getAllUnreadRequestCount();
        $headerData['report'] = $this->request->getAllUnreadReportCount();

        $this->view('admin/templates/header', $headerData);
        $this->view($page, $data);
        $this->view('admin/templates/footer', $load);
    }
}