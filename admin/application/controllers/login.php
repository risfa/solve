<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		session_start();
		$this->load->helper('url');
		$this->load->model('admin_model');
		if(isset($_SESSION['username'])){
			session_destroy();	
		}
		
	}
	public function index()
	{
		$this->load->view('login');
		
	}
	
	public function doLogin(){
		$wheredata = array();
		$wheredata['username'] = $_POST['username'];
		$wheredata['password'] = md5($_POST['password']);
		$login = $this->admin_model->get_data("ms_admin",$wheredata);
		if(isset($login) && !empty($login)){
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['status'] = $login['status'];
			if($login['status'] == "superadmin"){
				$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
				foreach($allEvent as $k => $v){
					$_SESSION['event'][] = $v['event_name'];
				}
				//redirect("home/".$_SESSION['event'][0]);
				redirect("home/".$_SESSION['event'][0]);
			}else{
				if($login['status'] == "admin"){
					$_SESSION['event'][] = $login['event_name'];
					redirect("admin_event_dashboard/".$_SESSION['event'][0]);
				}else{
					$_SESSION['event'][] = $login['event_name'];
					redirect("tl_event_dashboard/".$_SESSION['event'][0]);
				}
			}
		}else{
			$this->session->set_flashdata('message','Wrong Username or Password');
			redirect("login");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */