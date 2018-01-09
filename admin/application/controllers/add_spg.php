<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_spg extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("admin_model");
		session_start();
		if(!isset($_SESSION['username'])){
			redirect('login');
		}
	}
	public function index()
	{
		//set content
		$class = array();
		$class['active_insert_spg'] = "class='active'";
		$class['active_tl'] = "class='active'";
		$dataContent = array();
		$event = urldecode($this->uri->segment(2,0));
		$dataContent['class'] = $class;
		$dataContent['event'] = $_SESSION['event'];
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('add_spg','',true);
		$dataContent['event_selected'] = $event;
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function doAdd(){
		$data = array();
		$data['leader_name'] = $_SESSION['username'];
		$data['spg_name'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['event_name'] = $_SESSION['event'][0];
		
		$datas = $this->admin_model->insert_data("ms_spg",$data);
		$this->session->set_flashdata("message",array("success","Data Inserted"));
		redirect("insert_spg/".$_SESSION['event'][0]);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */