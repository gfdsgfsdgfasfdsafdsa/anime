<?php
class RequestReportModel extends Model {
    /* Request */
    public function getAllUnreadRequestCount(){
        return count($this->db->query("select id from request where isRead = 0"));
    }

    public function getAllRequest(){
        return $this->db->query("select * from request order by isRead asc, id desc, status desc");
    }

    public function deleteRequest(){
        $this->db->query("delete from request where id = ". htmlEncode($_GET['id']));
    }

    public function deleteAllRequest(){
        $this->db->query("delete from request where status = 'done'");
    }

    public function markAsDoneRequest(){
        $this->db->query("update request set status = 'done' where id = ". htmlEncode($_GET['id']));
    }

    public function updateReadRequest(){
        $this->db->query("update request set isRead = 1");
    }

    /* Report */
    public function getAllUnreadReportCount(){
        return count($this->db->query("select id from report where isRead = 0"));
    }

    public function getAllReport(){
        return $this->db->query("select * from report order by isRead asc, id desc");
    }

    public function deleteSelectedReport($id){
        $this->db->query("delete from report where id = ". htmlEncode($id));
    }

    public function updateReadReport(){
        $this->db->query("update report set isRead = 1");
    }

}