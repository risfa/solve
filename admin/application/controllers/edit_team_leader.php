<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_team_leader extends CI_Controller {

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
		$id = $this->uri->segment(2,0);
		$data_tl = $this->admin_model->get_data("ms_admin",array("admin_id"=>$id));
		$data = array();
		$data['data_tl'] = $data_tl;
		$class = array();
		$event = urldecode($this->uri->segment(3,0));
		$class['active_insert_tl'] = "class='active'";
		$class['active_admin_event'] = "class='active'";
		$dataContent = array();
		$dataContent['class'] = $class;
//		$dataContent['event'] = $_SESSION['event'];
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$data['event'] = $allEvent;
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('edit_team_leader',$data,true);
		$dataContent['event_selected'] = $event;
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function doEdit(){
		$data = array();
		$data_misc = array();
		$id = $_POST['id'];
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['event_name'] = $_SESSION['event'][0];
		$data['status'] = "leader";
		$data_misc['hp'] = $_POST['hp'];
		$data_misc['email'] = $_POST['mail'];
		$data_misc['alamat'] = $_POST['address'];
		$data_misc['gender'] = $_POST['gender'];
		$data['misc'] = json_encode($data_misc);
		
		$datas = $this->admin_model->update_data("ms_admin","admin_id",$id,$data);
		$this->session->set_flashdata("message",array("success","Data Updated"));
		redirect("insert_team_leader/".$_SESSION['event'][0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */