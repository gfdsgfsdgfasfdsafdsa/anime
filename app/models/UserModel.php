<?php
class UserModel extends Model {
    public function insert(){
        $this->db->query("insert into users(username, password, role) values(:username, :password, :role)", [
            ':username' => htmlEncode($_POST['username']),
            ':password' => hashPassword($_POST['password']),
            ':role' => htmlEncode($_POST['role']),
        ]);
    }
    public function getAll(){
        return $this->db->query("select * from users");
    }
    public function delete(){
        $this->db->query("delete from users where id = ". htmlEncode($_GET['id']));
    }
    public function get($id){
        return $this->db->query("select * from users where id = ". htmlEncode($id))[0];
    }
    public function update(){
        $this->db->query("update users set username = :username, password = :password, role = :role where id = ".htmlEncode($_GET['id']),
            [
                ':username' => htmlEncode($_POST['username']),
                ':password' => hashPassword($_POST['password']),
                ':role' => htmlEncode($_POST['role'])
            ]);
    }

    public function isUserNameUnique($username ,$newUsername){
        $username = htmlEncode($username);
        $newUsername = htmlEncode($newUsername);
        return count($this->db->query("select username from users where username = '".$newUsername."' and username != '".$username."'")) == 0;
    }

    public function loggedIn($username, $password){
        $userDetails = $this->getByUsername($username);

        if($userDetails){
            if(password_verify($password, $userDetails->password)){
                Session::set('user', $userDetails);
                return true;
            }
        }

        return false;
    }

    public function getByUsername($username){
        return $this->db->query("SELECT * FROM users WHERE username = :username",[
            ':username' => htmlEncode($username),
        ])[0];
    }
}