<?php
class Home extends Controller{
    public function __construct()
    {
        $this->homeModel = $this->model('HomeModel');
        $this->animePerpage = 10;
    }
    /* Helper Function */
    private function checkPage($totalPage, $redirect){
        $page = 0;
        if(!isset($_GET['page']) || $_GET['page'] == null){
            $page = 1;
        }else{
            if($_GET['page'] > $totalPage){
                redirect($redirect);
            }else{
                $page = $_GET['page'];
            }
        }
        return $page;
    }

    public function index(){
        $this->view('index');
        $this->view('templates/footer');
    }

    public function contact(){
        $this->view('templates/header');
        $this->view('contact');
        $this->view('templates/footer');
    }



    public function home(){
        $this->sliderModel = $this->model('SliderModel');
        $data['sliderItems'] = $this->sliderModel->getAll();

        $animePerPage = $this->animePerpage;
        $data['totalPage'] = ceil($this->homeModel->getAnimeCount()/$animePerPage);

        $data['page'] = $this->checkPage($data['totalPage'], 'home?page=1');

        if(isset($_POST['enteredPage'])){
            if(is_numeric($_POST['enteredPage'])){
                if($_POST['enteredPage'] > $data['totalPage']){
                    redirect('home?page='.$data['totalPage']);
                }else{
                    redirect('home?page='.$_POST['enteredPage']);
                }
            }else{
                redirect('home?page=1');
            }
        }

        $pageStart = ($data['page']-1)*$animePerPage;

        $data['animes'] = $this->homeModel->getAnimeLimit($pageStart, $animePerPage, '', ' order by a.id desc');

        $this->view_page('home', $data, 'Anime | Home');
    }

    public function search(){
        if(!isset($_GET['keyword']) || empty($_GET['keyword']))
            redirect('home');

        $animePerPage = $this->animePerpage;
        $data['totalPage'] = ceil($this->homeModel->getAnimeCount("where a.title like '%".$_GET['keyword']."%'")/$animePerPage);

        $data['page'] = $this->checkPage($data['totalPage'], 'search?keyword='.$_GET['keyword'].'&page=1');

        if(isset($_GET['enteredPage'])){
            if(is_numeric($_GET['enteredPage'])){
                if($_GET['enteredPage'] > $data['totalPage']){
                    redirect('search?keyword='.$_GET['keyword'].'&page='.$data['totalPage']);
                }else{
                    redirect('search?keyword='.$_GET['keyword'].'&page='.$_GET['enteredPage']);
                }
            }else{
                redirect('search?keyword='.$_GET['keyword'].'&page=1');
            }
        }

        $pageStart = ($data['page']-1)*$animePerPage;

        $data['animes'] = $this->homeModel->getAnimeLimit($pageStart, $animePerPage, "where a.title like '%".$_GET['keyword']."%'", ' order by a.id asc');

        $this->view_page('search', $data, 'Anime | Search');
    }

    public function filter(){
        if(!isset($_GET['keyword']) || !isset($_GET['sort'])){
            redirect('filter?sort=default&keyword=&page=1');
        }

        $max = 0;
        $genreSelectedLength = 0;
        $typeSelectedLength = 0;
        $yearSelectedLength  = 0;
        if(isset($_GET['genre']) && !empty($_GET['genre'])){
            if(count($_GET['genre']) > $max){
                $max = count($_GET['genre']);
            }
            $genreSelectedLength = count($_GET['genre']);
        }
        if(isset($_GET['type']) && !empty($_GET['type'])){
            if(count($_GET['type']) > $max){
                $max = count($_GET['type']);
            }
            $typeSelectedLength = count($_GET['type']);
        }
        if(isset($_GET['year']) && !empty($_GET['year'])){
            if(count($_GET['year']) > $max){
                $max = count($_GET['year']);
            }
            $yearSelectedLength = count($_GET['year']);
        }

        $data['genres_selected'] = []; $data['types_selected'] = []; $data['year_selected'] = [];
        for($i = 0; $i < $max; $i++){
            if($genreSelectedLength > 0 && $genreSelectedLength > $i){
                array_push( $data['genres_selected'], $_GET['genre'][$i]);
            }
            if($typeSelectedLength > 0 && $typeSelectedLength > $i){
                array_push($data['types_selected'], $_GET['type'][$i]);
            }
            if($yearSelectedLength > 0 && $yearSelectedLength > $i){
                array_push($data['year_selected'], $_GET['year'][$i]);
            }
        }

        //Genrate Url for pagination
        $genreUrl = join('&genre%5B%5D=', $data['genres_selected']);
        $genreUrl = !empty($genreUrl) ? 'genre%5B%5D='.$genreUrl.'&' : '';
        $typeUrl = join('&type%5B%5D=', $data['types_selected']);
        $typeUrl = !empty($typeUrl) ? 'type%5B%5D='.$typeUrl.'&' : '';
        $yearUrl = join('&year%5B%5D=', $data['year_selected']);
        $yearUrl = !empty($yearUrl) ? 'year%5B%5D='.$yearUrl.'&' : '';
        $sortUrl = '';
        if(isset($_GET['sort'])){
            $sortUrl = 'sort='.$_GET['sort'].'&';
        }
        $data['url_'] = $genreUrl.$typeUrl.$yearUrl.$sortUrl;

        $query = 'where ';
        if(!empty($data['genres_selected'])){
            $query .= 'a.slug in (select animeSlug from animegenre where genreId in ('.join(',', $data['genres_selected']).') group by animeSlug) and ';
        }
        if(!empty($data['types_selected'])){
            $query .= 'a.slug in (select animeSlug from animetype where typeId in ('.join(',', $data['types_selected']).') group by animeSlug) and ';
        }
        if(!empty($data['year_selected'])){
            $query .= '(select EXTRACT(YEAR FROM (dateFrom))) in ('.join(',', $data['year_selected']).') and ';
        }
        if(strlen($query) > 10){
            $query = rtrim($query, 'and ');
        }else{
            $query = '';
        }

        //Sort in filter query
        $order = '';
        $sort = array(
            'default' => ' order by a.id asc',
            'a_to_z' => ' order by title asc',
        );
        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            foreach($sort as $key => $value){
                if($_GET['sort'] == $key){
                    $order .= $value;
                    break;
                }
            }
        }

        //Keywords // Pagination
        if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
            $query = $query == '' ? " where a.title like '%".$_GET['keyword']."%' or
                a.titleKeywords like '%".$_GET['keyword']."%' ": $query." and a.title like '%".$_GET['keyword']."%' or
                 a.titleKeywords like '%".$_GET['keyword']."%' ";
        }
        //print_r($query); die();

        $animePerPage = $this->animePerpage;
        $data['totalPage'] = ceil($this->homeModel->getAnimeCount($query)/$animePerPage);

//        if(!isset($_GET['page']) || $_GET['page'] == null){
//            $data['page'] = 1;
//        }else{
//            $data['page'] = $_GET['page'];
//        }
        $data['page'] = $this->checkPage($data['totalPage'], 'filter?'.$data['url_'].'keyword='.(isset($_GET['keyword']) ? $_GET['keyword'] : '').'&page=1');

        $pageStart = ($data['page']-1)*$animePerPage;

        if($data['totalPage'] == 0) $data['totalPage'] = 1;

        if(isset($_POST['enteredPage'])){
            if(is_numeric($_POST['enteredPage'])){
                if($_POST['enteredPage'] > $_POST['totalPage']){
                    print_r($_POST['totalPage']);
                    redirect('filter?'.$_POST['url_'].'keyword='.$_POST['keyword'].'&page='.$_POST['totalPage']);
                }else{
                    redirect('filter?'.$_POST['url_'].'keyword='.$_POST['keyword'].'&page='.$_POST['enteredPage']);
                }
            }else{
                redirect('filter?'.$_POST['url_'].'keyword='.$_POST['keyword'].'&page=1');
            }
        }

        $data['animes'] = $this->homeModel->getAnimeLimit($pageStart, $animePerPage, $query, $order);

        $this->view_page('filter', $data, 'Anime | Filter');
    }

    public function animeByLetter(){
        $animePerPage = $this->animePerpage;

        $query = '';
        $q = '';
        if(!isset($_GET['q']) || empty($_GET['q']) || $_GET['q'] == 'all'){
            $query = '';
            $q = 'all';
        }else{
            if($_GET['q'] == '0-9'){
                $query = "where";
                for($i = 0; $i <= 9; $i++) $query .= " a.title like '$i%' or";
                $query = rtrim($query, 'or');
                $q = '0-9';
            }else{
                $query = "where a.title like '".$_GET['q']."%'";
                $q = $_GET['q'];
            }
        }

        $data['totalPage'] = ceil($this->homeModel->getAnimeCount($query)/$animePerPage);

        $data['page'] = $this->checkPage($data['totalPage'], 'az-list?q='.$q.'&page=1');

        $pageStart = ($data['page']-1)*$animePerPage;

        if($data['totalPage'] == 0) $data['totalPage'] = 1;

        if(isset($_POST['enteredPage'])){
            if(is_numeric($_POST['enteredPage'])){
                if($_POST['enteredPage'] > $data['totalPage']){
                    redirect('az-list?q='.$q.'&page='.$data['totalPage']);
                    die('test');
                }else{
                    redirect('az-list?q='.$q.'&page='.$_POST['enteredPage']);
                }
            }else{
                redirect('az-list?q=all');
            }
        }

        $data['q'] = $q;
        $data['animes'] = $this->homeModel->getAnimeLimit($pageStart, $animePerPage, $query);

        $this->view_page('animeByLetter', $data, 'Anime | A to Z');
    }

    public function recentlyAdded(){
        $animePerPage = $this->animePerpage;
        $data['totalPage'] = ceil($this->homeModel->recentCount()/$animePerPage);

        $data['page'] = $this->checkPage($data['totalPage'], 'recently-added?page=1');

        if(isset($_POST['enteredPage'])){
            if(is_numeric($_POST['enteredPage'])){
                if($_POST['enteredPage'] > $data['totalPage']){
                    redirect('recently-added?page='.$data['totalPage']);
                }else{
                    redirect('recently-added?page='.$_POST['enteredPage']);
                }
            }else{
                redirect('recently-added?page=1');
            }
        }

        $pageStart = ($data['page']-1)*$animePerPage;

        $data['animes'] = $this->homeModel->recentlyAdded($pageStart, $animePerPage);

        $this->view_page('recently-added', $data, 'Anime | Recently Updated');
    }

    public function view_page($page, $data = null, $title = null){
        if($title != null){
            $headerData['title'] = $title;
            $this->view('templates/header', $headerData);
        }else{
            $this->view('templates/header');
        }

        $this->animeTypeModel = $this->model('AnimeTypeModel');

        //$d['recentlyAdded'] = array();
        $data['animeType'] = $this->animeTypeModel->groupBySlug();

        $this->view($page, $data);

        $this->episodeModel = $this->model('EpisodeModel');
        $d['recentlyAdded'] = $this->episodeModel->recentlyAdded();

        $this->typeModel = $this->model('TypeModel');
        $this->genreModel = $this->model('GenreModel');
        $d['types'] = $this->typeModel->getAll();
        $d['genres'] = $this->genreModel->getAll();
        $d['minMaxYear'] = $this->homeModel->minMaxYear();

        $this->view('templates/side-items', $d);
        $this->view('templates/footer');
    }
}