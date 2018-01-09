<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_team_leader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
		session_start();
		if(!isset($_SESSION['username'])){
			redirect('login');
		}
	}
	public function index()
	{
		//set content
		$event = urldecode($this->uri->segment(2,0));
		$class = array();
		$class['active_insert_tl'] = "class='active'";
		$class['active_admin_event'] = "class='active'";
		$dataContent = array();
		$data = array();
		$data['event_selected'] = $event;
		$dataContent['class'] = $class;
		$dataContent['event'] = $_SESSION['event'];
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['event_selected'] = $event;
		$dataContent['content'] = $this->load->view('add_team_leader',$data,true);
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function doAdd(){
		$data = array();
		$data_misc = array();
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['event_name'] = $_POST['event'];
		$data['status'] = "leader";
		$data_misc['hp'] = $_POST['hp'];
		$data_misc['email'] = $_POST['mail'];
		$data_misc['alamat'] = $_POST['address'];
		$data_misc['gender'] = $_POST['gender'];
		$data['misc'] = json_encode($data_misc);
		
		$datas = $this->admin_model->insert_data("ms_admin",$data);
		$this->session->set_flashdata("message",array("success","Data Inserted"));
		redirect("insert_team_leader/".$_POST['event']);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */