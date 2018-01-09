<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_spg extends CI_Controller {

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
		$wheredata = array();
		$wheredata['leader_name'] = $_SESSION['username'];
		$wheredata['event_name'] = $event;
		$counter = $this->admin_model->get_count_data("ms_spg",array("leader_name"=>$_SESSION['username']));
		$data_spg = $this->admin_model->get_data_all("ms_spg","spg_id","",$wheredata);
		$class = array();
		$data = array();
		$data['counter'] = $counter;
		$data['data_spg'] = $data_spg;
		$class['active_insert_spg'] = "class='active'";
		$class['active_tl'] = "class='active'";
		$dataContent = array();
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('insert_spg',$data,true);
		$dataContent['event_selected'] = $event;
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function doDelete(){
		$id = $this->uri->segment(3,0);
		$this->admin_model->delete_data("ms_spg","spg_id",$id);
		$this->session->set_flashdata("message",array("success","Data Deleted"));
		redirect("insert_spg/".$_SESSION['event'][0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */