<?php
class GenreModel extends Model {
    public function insert(){
        $this->db->query("insert into genre(genreName) values(:genreName)", [
                   ':genreName' => htmlEncode($_POST['genreName'])

        ]);
    }
    public function getAll(){
        return $this->db->query("select * from genre order by id desc");
    }
    public function delete(){
        $this->db->query("delete from genre where id = ". htmlEncode($_GET['id']));
    }
    public function get($id){
        return $this->db->query("select * from genre where id = ". $id)[0];
    }
    public function update(){
        $this->db->query("update genre set genreName = :genreName where id = ".htmlEncode($_GET['id']),
            [
                ':genreName' => htmlEncode($_POST['genreName'])
        ]);
    }
}