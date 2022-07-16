<?php
class AnimeGenreModel extends Model {
    public function insert($animeSlug, $genreIds){
        foreach ($genreIds as $g){
            $this->db->query("insert into animegenre(animeSlug,genreId) 
        values(:animeSlug,:genreId)", [
                ':animeSlug' => $animeSlug,
                ':genreId' => htmlEncode($g)
            ]);
        }
    }

    public function getAll(){
        return $this->db->query("select animeSlug, g.genreName from animegenre a join genre g 
                where a.genreId = g.id order by g.genreName asc");
    }

    public function getAllGenreTextFormat(){
        $data = array();
        foreach ($this->getAll() as $d){
            if(!array_key_exists($d->animeSlug, $data)){
                $data[$d->animeSlug] = $d->genreName . ',';
            }else{
                $data[$d->animeSlug] = $data[$d->animeSlug].$d->genreName . ',';
            }
        }
        return $data;
    }

    public function deleteByAnimeSlug($slug){
        $this->db->query("delete from animegenre where animeSlug = '".htmlEncode($slug)."'");
    }

    public function deleteByTypeId($id){
        $this->db->query("delete from animegenre where genreId = ". htmlEncode($id));
    }

    public function getByAnimeSlug($animeSlug){
        $data = $this->db->query("select genreId from animegenre a join genre g on a.genreId = g.id where animeSlug = '".htmlEncode($animeSlug)."'");
        $ids = array();
        foreach ($data as $d)
            array_push($ids, $d->genreId);
        return $ids;
    }

    public function getGenreAndId($animeSlug){
        return $this->db->query("select genreId, genreName from animegenre a join genre g on a.genreId = g.id where animeSlug = '".htmlEncode($animeSlug)."'");
    }

}