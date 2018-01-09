<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Harga extends CI_Controller {

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
		$class = array();
		$data = array();
		$event = urldecode($this->uri->segment(2,0));
		$harga = $this->admin_model->get_data("ms_event",array("event_name"=>$event));
		$data['harga'] = $harga;
		$data['event_selected'] = $event;
		$class['active_harga'] = "class='active'";
		$class['active_admin_event'] = "class='active'";
		$dataContent = array();
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('harga',$data,true);
		//echo "<pre>";print_r($dataContent);die;
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function doUpdate(){
		$id = $_POST['id'];
		$data = array();
		$data['harga'] = $_POST['harga'];
		$event = $_POST['event'];
		$datas = $this->admin_model->update_data("ms_event","event_id",$id,$data);
		$this->session->set_flashdata("message",array("success","Data Updated"));
		redirect("harga/".$event);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */