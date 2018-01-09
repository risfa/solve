<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        /*
         * load model user that store all query for ms_admin
         */
        $this->load->model('user');
    }

    public function index()
    {
        /*
         * load view login
         */
        $this->load->view('login');
    }
    public function process(){
        /*
         * load lib validation
         */
        $this->load->library('form_validation');
        /*
         * set rules for validation
         */
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        /*
         * if true than continue process login
         */
        if ($this->form_validation->run() != FALSE) {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $response = $this->user->loginAdmin($username, $password);
            /*
             * if login success then set all session so user information can be stored
             */
            if ($response['status']) {
                $this->session->set_userdata('is_login',true);
                foreach ($response['data'] as $k => $v) {
                    $this->session->set_userdata('user_' . $k, $v);
                }
            }
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
    public function logout(){
        /*
         * logout and redirect login
         */
        $this->session->sess_destroy();
        redirect("/login");
    }
}
