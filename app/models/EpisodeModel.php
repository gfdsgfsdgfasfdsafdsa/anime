<?php
class EpisodeModel extends Model {
    public function insert(){
        $arr_count = count($_POST['episodeLink']);
        for($i = 0; $i < $arr_count; $i++){
            $this->db->query("insert into episode(animeSlug,episodeNumber,episodeLink) 
        values(:animeSlug,:episodeNumber,:episodeLink)", [
                ':animeSlug' => htmlEncode($_GET['anime']),
                ':episodeNumber' => htmlEncode($_POST['episodeNumber'][$i]),
                ':episodeLink' => htmlEncode($_POST['episodeLink'][$i]),
            ]);
        }
    }
    public function update(){
        $this->db->query("update episode set episodeNumber = :episodeNumber, episodeLink = :episodeLink where id = ".htmlEncode($_GET['id']),
            [
                ':episodeNumber' => htmlEncode($_POST['episodeNumber']),
                ':episodeLink' => htmlEncode($_POST['episodeLink'])
            ]);
    }

    public function getBySlug($slug){
        return $this->db->query("select * from episode where animeSlug = '".htmlEncode($slug)."'");
    }

    public function deleteByAnimeSlug($animeSlug){
        $this->db->query("delete from episode where animeSlug = '".$animeSlug."'");
    }

    public function delete($id){
        $this->db->query("delete from episode where id = ". htmlEncode($id));
    }

    public function get($id){
        return $this->db->query("select * from episode where id = ". htmlEncode($id))[0];
    }

    public function getEpisodesBySlug($slug){
        return $this->db->query("SELECT * FROM episode WHERE animeSlug = '".htmlEncode($slug)."' group by episodeNumber order by episodeNumber asc");
    }

    public function getEpisodeLink($animeSlug ,$episodeNumber){
        $q = $this->db->query("select episodeLink from episode where animeSlug = '".htmlEncode($animeSlug)."' and episodeNumber = ".htmlEncode($episodeNumber));
        return count($q) ? $q[0]->episodeLink : 0;
    }

    public function recentlyAdded(){
        return $this->db->query("select a.slug, e.episodeNumber, a.title, a.posterLink from episode e, anime a where e.animeSlug = a.slug order by e.id desc limit 6");
    }
}