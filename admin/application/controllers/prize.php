<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prize extends CI_Controller {

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
		$eventLoc = $this->admin_model->get_data("ms_event",array("event_name"=>$event));
		$prize = $this->admin_model->get_data("ms_prize",array("event_name"=>$event));
		$data['prize'] = $prize;
		$data['event_selected'] = $event;
		if($eventLoc['location'] > 1) {
			$loc = $this->admin_model->get_data_all("ms_location","location_id","",array("event_name"=>$event));
			$data['location'] = $loc;
		}
		$class['active_prize'] = "class='active'";
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
		$dataContent['content'] = $this->load->view('prize',$data,true);
		//echo "<pre>";print_r($dataContent);die;
			$this->load->view('template', $dataContent);
	}
	
	public function doUpdate() {
		$id = $_POST['id'];
		$dataHadiah = array();
		// $dataHadiahTemp = array();
		$hadiah = array_filter($_POST['hadiah']);
		$totalHadiah = array_filter($_POST['totalHadiah']);
		$locationTotalHadiah = (isset($_POST['locationTotalHadiah'])) ? array_filter(array_unique($_POST['locationTotalHadiah'])) : "";
		$event = $_POST['event'];
		$i = 0;
		foreach($hadiah as $key=>$value) {
			if(!empty($locationTotalHadiah) && $locationTotalHadiah != "") {
				$x = 0;
				foreach($locationTotalHadiah as $k=>$v) {
					$dataHadiah[$hadiah[$key]][$x] = array($v=>$totalHadiah[$i],"redeem"=>0);
					$x++;
					$i++;
				}
			} else {
				$dataHadiah[$i][$hadiah[$key]] = $totalHadiah[$key];
				$dataHadiah[$i]['redeem'] = 0;
				$i++;
			}
		}
		
		// if(!empty($locationTotalHadiah) && $locationTotalHadiah != "") {
			// $i = 0;
			// foreach($dataHadiahTemp as $key=>$value) {
				// foreach($value as $k=>$v) {
					// $dataHadiah[$k][$i] = array($key=>$v,"redeem"=>0);
					// $i++;
				// }
			// }
		// }
		$data['prize'] = json_encode($dataHadiah);
		$datas = $this->admin_model->update_data("ms_prize","prize_id",$id,$data);
		$this->session->set_flashdata("message",array("success","Data Updated"));
		redirect("prize/".$event);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */