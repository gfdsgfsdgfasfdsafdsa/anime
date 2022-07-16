<?php
class TypeModel extends Model {
    public function insert(){
        $this->db->query("insert into type(typeName,backgroundColor) values(:typeName,:backgroundColor)", [
            ':typeName' => htmlEncode($_POST['typeName']),
            ':backgroundColor' => htmlEncode($_POST['backgroundColor'])
        ]);
    }
    public function getAll(){
        return $this->db->query("select * from type order by id desc");
    }
    public function delete(){
        $this->db->query("delete from type where id = ". htmlEncode($_GET['id']));
    }
    public function get($id){
        return $this->db->query("select * from type where id = ". $id)[0];
    }
    public function update(){
        $this->db->query("update type set typeName = :typeName, backgroundColor = :backgroundColor where id = ".htmlEncode($_GET['id']),
            [
                ':typeName' => htmlEncode($_POST['typeName']),
                ':backgroundColor' => htmlEncode($_POST['backgroundColor'])
            ]);
    }


}