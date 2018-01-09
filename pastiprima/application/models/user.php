<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model
{
    function loginAdmin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $user = $this->db->get('ms_admin');
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