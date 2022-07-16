<?php
class SliderModel extends Model {
    public function insert(){
        if(isset($_POST['marginTop']) && is_numeric($_POST['marginTop'])){
            $this->db->query("insert into slider(animeSlug, bannerLink, marginTop) values(:animeSlug, :bannerLink, :marginTop)", [
                ':animeSlug' => htmlEncode($_POST['anime']),
                ':bannerLink' => htmlEncode($_POST['bannerLink']),
                ':marginTop' => htmlEncode($_POST['marginTop']),
            ]);
        }elseif(isset($_POST['marginBottom']) && is_numeric($_POST['marginBottom'])){
            $this->db->query("insert into slider(animeSlug, bannerLink, marginBottom) values(:animeSlug, :bannerLink, :marginBottom)", [
                ':animeSlug' => htmlEncode($_POST['anime']),
                ':bannerLink' => htmlEncode($_POST['bannerLink']),
                ':marginBottom' => htmlEncode($_POST['marginBottom']),
            ]);
        }elseif (isset($_POST['marginTop']) && is_numeric($_POST['marginTop']) && isset($_POST['marginBottom']) && is_numeric($_POST['marginBottom'])){
            $this->db->query("insert into slider(animeSlug, bannerLink) values(:animeSlug, :bannerLink)", [
                ':animeSlug' => htmlEncode($_POST['anime']),
                ':bannerLink' => htmlEncode($_POST['bannerLink']),
                ':marginBottom' => htmlEncode($_POST['marginBottom']),
                ':marginTop' => htmlEncode($_POST['marginTop']),
            ]);
        }else{
            $this->db->query("insert into slider(animeSlug, bannerLink) values(:animeSlug, :bannerLink)", [
                ':animeSlug' => htmlEncode($_POST['anime']),
                ':bannerLink' => htmlEncode($_POST['bannerLink']),
            ]);
        }
    }
    public function getAll(){
        return $this->db->query("select a.slug, a.title, s.id, a.storySypnosis, s.bannerLink, s.marginTop, s.marginBottom  from anime a, slider s where a.slug = s.animeSlug order by s.id desc");
    }

    public function getAllAnimeNotExistInSlider(){
        return $this->db->query("select slug,title from anime where not exists (select animeSlug from slider where slug = animeSlug)");
    }
    public function delete(){
        $this->db->query("delete from slider where id = ". htmlEncode($_GET['id']));
    }

}