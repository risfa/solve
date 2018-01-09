<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    public  function __construct()
    {
        parent:: __construct();
    }

    public function index()
    {
        $is_login=$this->session->userdata('is_login');
        if($is_login==true){
            $this->load->view('welcome_message');
        }else{
           redirect('login');
        }
    }
}
