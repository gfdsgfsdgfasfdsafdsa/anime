<?php
class AnimeModel extends Model {
    public function insert(){
        $this->db->query("insert into anime(title,slug,status,posterLink,dateFrom,dateTo,storySypnosis,titleKeywords) 
        values(:title,:slug,:status,:posterLink,:dateFrom,:dateTo,:storySypnosis,:titleKeywords)", [
            ':title' => htmlEncode($_POST['title']),
            ':slug' => generateSlug(htmlEncode($_POST['title'])),
            ':status' => htmlEncode($_POST['status']),
            ':posterLink' => htmlEncode($_POST['posterLink']),
            ':dateFrom' => htmlEncode($_POST['dateFrom']),
            ':dateTo' => htmlEncode($_POST['dateTo']),
            ':storySypnosis' => htmlEncode($_POST['storySypnosis']),
            ':titleKeywords' => htmlEncode($_POST['titleKeywords'])
        ]);
    }

    public function update(){
        $this->db->query("update anime set title = :title, slug = :slug,status = :status, posterLink = :posterLink,
                 dateFrom = :dateFrom,dateTo = :dateTo,storySypnosis = :storySypnosis,titleKeywords = :titleKeywords
                 where slug = '".$_GET['anime']."'", [
            ':title' => htmlEncode($_POST['title']),
            ':slug' => generateSlug(htmlEncode($_POST['title'])),
            ':status' => htmlEncode($_POST['status']),
            ':posterLink' => htmlEncode($_POST['posterLink']),
            ':dateFrom' => htmlEncode($_POST['dateFrom']),
            ':dateTo' => htmlEncode($_POST['dateTo']),
            ':storySypnosis' => htmlEncode($_POST['storySypnosis']),
            ':titleKeywords' => htmlEncode($_POST['titleKeywords'])
        ]);
    }

    public function getSlugLastInserted(){
        return $this->db->query('select slug from anime where id = (select max(id) as id from anime)')[0]->slug;
    }

    public function getAll(){
        return $this->db->query("select * from anime order by id desc");
    }
    public function delete(){
        $this->db->query("delete from anime where slug = '".htmlEncode($_GET['anime'])."'");
    }
    public function get($id){
        return $this->db->query("select * from anime where id = ". $id)[0];
    }

    public function getAnimeBySlug($slug){
        return $this->db->query("select * from anime where slug = '".$slug."'")[0];
    }

    public function existsSlug($slug){
        return count($this->db->query("select slug from anime where slug = '".$slug."'"));
    }

    public function slugExistExcept($value, $except){
        return count($this->db->query("select slug from anime where slug = '".htmlEncode($value)."'
                and slug != '".htmlEncode($except)."'"));
    }

}