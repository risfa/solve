<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public  function __construct()
    {
        parent:: __construct();
        $this->load->model('login_m');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $is_login=$this->session->userdata('is_login');
        if($is_login==true){
            redirect('home');
        }else{
            $this->load->view('login');
        }
    }
    public function process(){
        $status=array();
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($this->form_validation->run() != FALSE) {
            $login = $this->login_m->dologin($_POST['username'], $_POST['password']);
            if ($login) {
                $this->session->set_userdata('is_login', true);
                $this->session->set_userdata('username', $login->username);
                $this->session->set_userdata('status', $login->status);
                $status['status'] = true;
            } else {
                $status['status'] = false;
                $status['message'] = "Username and Password not valid";
            }
        }else{
            $status['status'] = false;
            $status['message'] = validation_errors();
        }
        echo json_encode($status);
    }
    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_userdata('is_login',false);
        header('location:'.site_url('/login'));
    }
}
