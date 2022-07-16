<?php
class AnimeTypeModel extends Model {
    public function insert($animeSlug, $typeId){
        foreach ($typeId as $t){
            $this->db->query("insert into animetype(animeSlug,typeId) 
        values(:animeSlug,:typeId)", [
                ':animeSlug' => $animeSlug,
                ':typeId' => $t
            ]);
        }
    }

    public function getAll(){
        return $this->db->query("select animeSlug, t.typeName from animetype a join type t where a.typeId = t.id");
    }

    public function getAllTypeTextFormat(){
        $data = array();
        foreach ($this->getAll() as $d){
            if(!array_key_exists($d->animeSlug, $data)){
                $data[$d->animeSlug] = $d->typeName . ',';
            }else{
                $data[$d->animeSlug] = $data[$d->animeSlug].$d->typeName . ',';
            }
        }
        return $data;
    }

    public function deleteByAnimeSlug($slug){
        $this->db->query("delete from animetype where animeSlug = '".htmlEncode($slug)."'");
    }

    public function deleteByTypeId($id){
        $this->db->query("delete from animetype where typeId = ". htmlEncode($id));
    }

    public function getByAnimeSlug($animeSlug){
        $data = $this->db->query("select typeId from animetype a join type t on a.typeId = t.id where animeSlug = '".htmlEncode($animeSlug)."'");
        $ids = array();
        foreach ($data as $d)
            array_push($ids, $d->typeId);
        return $ids;
    }

    public function getTypeAndId($animeSlug){
        return $this->db->query("select typeId, typeName from animetype a join type t on a.typeId = t.id where animeSlug = '".htmlEncode($animeSlug)."'");
    }

    public function groupBySlug(){
        $data = $this->db->query("select a.animeSlug, t.typeName, t.backgroundColor from animetype a, type t where a.typeId = t.id");
        $items = array();
        foreach ($data as $d){
            $c = 'black';
            if(!empty($d->backgroundColor)){
                $c = $d->backgroundColor;
            }
            $items[$d->animeSlug][] = array('type' => $d->typeName, 'backgroundColor' => $c);
        }
        return $items;
    }

}