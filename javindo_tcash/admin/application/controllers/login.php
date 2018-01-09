<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	public function index()
	{
		$this->load->view('login');
	}
	
	public function doLogin(){
		$login = $this->admin_model->get_data_admin($_POST["username"],md5($_POST["password"]));
		if(isset($login) && !empty($login)){
			$this->admin_model->setLogin();
			$this->admin_model->updateLastLogin($login["admin_id"],$login["status"],date("Y-m-d H:i:s"));
			$this->session->set_userdata("admin_id",$login['admin_id']);
			$this->session->set_userdata("username",$login['username']);
			$this->session->set_userdata("status",$login['status']);
			if($login['status'] == "admin"){
				redirect("admin_event_dashboard/");
			}else{
				redirect("tl_event_dashboard/");
			}
		}else{
			$this->session->set_flashdata('message','Wrong Username or Password');
			redirect("login");
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('http://5dapps.com/solve/javindo_tcash/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */