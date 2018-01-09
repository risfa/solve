<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_team_leader extends CI_Controller {

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
		$wheredata = array();
		$wheredata["status"] = "leader";
		$event = urldecode($this->uri->segment(2,0));
		$wheredata["event_name"] = $event;
		
		$all_tl = $this->admin_model->get_data_all("ms_admin","admin_id","",$wheredata);
		$total_tl = $this->admin_model->get_data("ms_event",array("event_name"=>$event));
		$data = array();
		$data['all_tl'] = $all_tl;
		$data['total_tl'] = $total_tl['total_tl'];
		$data['event_selected'] = $event;
		$class = array();
		$class['active_insert_tl'] = "class='active'";
		$class['active_admin_event'] = "class='active'";
		$dataContent = array();
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('insert_team_leader',$data,true);
		$dataContent['event_selected'] = $event;
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
	
	public function doDelete(){
		$id = $this->uri->segment(3,0);
		$this->admin_model->delete_data("ms_admin","admin_id",$id);
		$this->session->set_flashdata("message",array("success","Data Deleted"));
		redirect($_SERVER['HTTP_REFERER']);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */