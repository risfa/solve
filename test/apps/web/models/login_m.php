<?php
class Login_m extends CI_Model {
    public function dologin($username,$password){
        $password=md5($password);
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query=$this->db->get('ms_admin');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return false;
        }
    }
}