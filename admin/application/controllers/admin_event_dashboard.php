<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_event_dashboard extends CI_Controller {

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
		$pattern = "/samsung.*/i";
		$class = array();
		$class['active_admin_event'] = "class='active'";
		$class['active_dashboard'] = "class='active'";
		$dataContent = array();
		$data = array();
		$event = urldecode($this->uri->segment(2,0));
		$wheredata = array("event_name"=>$event);
		$single_event = $this->admin_model->get_data("ms_event",$wheredata);
		$all_member = $this->admin_model->get_data_all("ms_member","member_id","",$wheredata);
		if(preg_match($pattern,$event)) {
			$all_soal = $this->admin_model->get_data_all("ms_soal","soal_id","",$wheredata);
			$all_jawaban = $this->admin_model->get_data_all("ms_jawaban","jawaban_id","",$wheredata);
		}
		$data['event'] = $single_event;
		$data['event_selected'] = $event;
		$data['all_member'] = $all_member;
		if($event == "Samsung Store") {			
			$data['all_soal'] = $all_soal;
			$data['all_jawaban'] = $all_jawaban;
		} else if ($event == "Lesehan Enduro") {
			$data['show_paket_harga'] = 1;
		}
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['event_selected'] = $event;
		$dataContent['content'] = $this->load->view('admin_event_dashboard',$data,true);
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */