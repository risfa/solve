<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{
    function loginAdmin($username, $password,$event_id)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('event_id', $event_id);
        $this->db->where('role_id !=', '4');
        $user = $this->db->get('user_access');
        if ($user->num_rows() > 0) {
            $response['data'] = $user->row();
            $response['status'] = true;
            $response['message'] = "login success";
        } else {
            $response['status'] = false;
            $response['message'] = "invalid username and password";
        }
        return $response;
    }
}