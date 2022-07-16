<?php
class AjaxModel extends Model {
    public function insertIntoRequest(){
        $this->db->query("insert into request(animeName) 
        values(:animeName)", [
            'animeName' => htmlEncode($_POST['anime']),
        ]);
    }

    public function insertIntoReport(){
        $this->db->query("insert into report(animeName, episodeNumber, reason) 
        values(:animeName, :episodeNumber, :reason)", [
            'animeName' => htmlEncode($_POST['animeName']),
            'episodeNumber' => htmlEncode($_POST['episodeNumber']),
            'reason' => htmlEncode($_POST['reason']),
        ]);
    }

}