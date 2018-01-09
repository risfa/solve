<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        /*
         * load model user that store all query for ms_admin
         */
        $this->load->model('ms_events');
        $this->load->model('user');
    }

    public function index()
    {
        /*
         * load view login
         */
        $data['events']=$this->ms_events->getAllEvents();
        $this->load->view('login',$data);
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
            $event_id = $this->input->post('event_id');
            /*
             * cek if super user or not
             */
            $su_username=$this->config->item('admin_username');
            $su_password=$this->config->item('admin_password');
            if($username==$su_username && $password==$su_password){
                /*
                 * set all session & login
                 */
                $this->session->set_userdata('is_login', true);
                $this->session->set_userdata('user_username', $su_username);
                $this->session->set_userdata('user_fullname', "superuser");
                $this->session->set_userdata('user_status', "superuser");
                $this->session->set_userdata('user_roles', "superuser");
                $this->session->set_userdata('user_user_id', 0);
                $response['status'] = true;
                $response['message'] = "login success";
            }else {
                $response = $this->user->loginAdmin($username, $password,$event_id);
                /*
                 * if login success then set all session so user information can be stored
                 */
                if ($response['status']) {
                    $this->session->set_userdata('is_login', true);
                    foreach ($response['data'] as $k => $v) {
                        if($k=='role_name'){
                            $k='status';
                        }
                        $this->session->set_userdata('user_' . $k, $v);
                    }
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
        // echo '<pre>'; print_r($this->session->all_userdata());exit;


       //  $allsession = $this->session->all_userdata();
        
       // echo $event_id;
        // $event_id = "";

       // $event_id =  ("".$this->session->userdata('user_event_id').""); 
        $this->session->sess_destroy();

        // to unset session data
                // $this->session->unset_userdata('is_login');
                // $this->session->unset_userdata('user_username');
                // $this->session->unset_userdata('user_fullname');
                // $this->session->unset_userdata('user_status');
                // $this->session->unset_userdata('user_roles');
                // $this->session->unset_userdata('user_user_id');
                // $this->session->unset_userdata('user_');

        // redirect("/login/?event=".$event_id);
        redirect('login');
        $this->cache->clean();
    }
}
