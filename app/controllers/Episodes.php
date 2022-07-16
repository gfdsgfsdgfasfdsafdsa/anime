<?php
class Episodes extends Controller {
    public function __construct()
    {
        $this->animeModel = $this->model('AnimeModel');
        $this->episodeModel = $this->model('EpisodeModel');
        $this->animeTypeModel = $this->model('AnimeTypeModel');
        $this->animeGenreModel = $this->model('AnimeGenreModel');
        $this->homeModel = $this->model('HomeModel');
        $this->typeModel = $this->model('TypeModel');
        $this->genreModel = $this->model('GenreModel');
    }

    public function selected(){
        if((!isset($_GET['anime']) && empty($_GET['anime'])) || !isset($_GET['episode']) || (!empty($_GET['episode']) && !is_numeric($_GET['episode']))
        || !$this->animeModel->getAnimeBySlug($_GET['anime'])){
            $this->view('error404/index');
            die();
        }else{
            if(empty($_GET['episode'])){
                $episode = 1;
            }else{
                $episode = $_GET['episode'];
            }
        }

        $data['episodes'] = $this->episodeModel->getEpisodesBySlug($_GET['anime']);

        if(count($data['episodes'])){
            if($_GET['episode'] > $data['episodes'][count($data['episodes'])-1]->episodeNumber
                || $_GET['episode'] < $data['episodes'][0]->episodeNumber){
//            $data['currentSelectedEpisode'] = $data['episodes'][0]->episodeNumber;
                redirect('watch?anime='.$_GET['anime'].'&episode='.$data['episodes'][0]->episodeNumber);
            }else{
                $data['currentSelectedEpisode'] = $_GET['episode'];
            }
        }

        $data['anime'] = $this->animeModel->getAnimeBySlug($_GET['anime']);
        $data['type'] = $this->animeTypeModel->getTypeAndId($_GET['anime']);
        $data['genre'] = $this->animeGenreModel->getGenreAndId($_GET['anime']);

        $data['episodeLink'] = $this->episodeModel->getEpisodeLink($_GET['anime'] ,$episode);

        //For next prev button
        $n = count($data['episodes']);
        $data['next'] = '';
        $data['prev'] = '';
        for($i = 0; $i < $n; $i++){
            if($data['episodes'][$i]->episodeNumber == $_GET['episode'] && $i+1 != $n){
                $data['next'] = $data['episodes'][$i+1]->episodeNumber;
            }
            if($data['episodes'][$i]->episodeNumber == $_GET['episode'] && $i != 0){
                $data['prev'] = $data['episodes'][$i-1]->episodeNumber;
            }
            if(!empty($data['next']) && !empty($data['prev'])) break;
        }

        $d['title'] = 'Anime | '.readableSlug($_GET['anime']). ' Episode '.$episode;
        $this->view_page('episode', $data, $d);
    }

    public function view_page($page, $d = null, $h = null){
        $this->view('templates/header', $h);

        $this->view($page, $d);

        $this->episodeModel = $this->model('EpisodeModel');
        $data['recentlyAdded'] = $this->episodeModel->recentlyAdded();
        $data['types'] = $this->typeModel->getAll();
        $data['genres'] = $this->genreModel->getAll();
        $data['minMaxYear'] = $this->homeModel->minMaxYear();

        $this->view('templates/side-items', $data);
        $this->view('templates/footer');
    }
}