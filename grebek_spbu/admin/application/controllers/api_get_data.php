<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_get_data extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
		session_start();
	}

	public function index()
	{
		$wheredata = array();
		$user = array();
		$merchant = array();
		$tmp_leader_name = array();
		$leader_name = array();
		$total = 0;
		$top_up = array("25000" => 0,"50000" => 0, "100000" => 0, "150000" => 0);
		$kategori = array("F&B" => 0, "Fashion" => 0, "Cosmetic" => 0, "Electronic" => 0, "Toys" => 0, "PasarBasah" => 0, "Others" => 0);
		$start_date = $this->input->post("start_date");
		$end_date = $this->input->post("end_date");
		$status = $this->input->post("status");
		if(strtotime($end_date) < strtotime($start_date)){
			echo "Time not valid";
		}else{
			if($start_date != "" && $end_date != "") {
				$wheredata['created >='] = $start_date . "00:00:00";
				$wheredata['created <='] = $end_date . "23:59:59";
			}
			if($status == "admin") {
				$tmp = "admin_name";
				$data_user = $this->admin_model->get_data_user($this->session->userdata("admin_id"),$wheredata);
				$data_merchant = $this->admin_model->get_data_merchant($this->session->userdata("admin_id"),$wheredata);
				$data_tl = $this->admin_model->get_all_data_tl();
			} else {
				$tmp = "created_by";
				$wheredata["admin_id"] = $this->session->userdata("admin_id");
				$data_user = $this->admin_model->get_data_user($this->session->userdata("admin_id"),$wheredata);
				$data_merchant = $this->admin_model->get_data_merchant($this->session->userdata("admin_id"),$wheredata);
				// $data_tl = $this->admin_model->get_all_data_spg($this->session->userdata("admin_id"));
			}
			// echo "<pre>";print_r($data_user);die;
			// echo "<pre>";print_r($data_merchant);die;
			
			// foreach($data_tl as $val) {
				// $tl[] = $val["username"];
			// }
			
			foreach($data_user as $value){
				$date = date("d F Y",strtotime($value['created']));
				// if(!isset($user[$date])) {
					// foreach($tl as $val) {
						// $user[$date][$val] = 0;
					// }
				// }
				if(isset($user[$date][$value[$tmp]])) {
					$user[$date][$value[$tmp]] += 1;
				} else {
					$user[$date][$value[$tmp]] = 1;
				}
				if(isset($top_up[$value["top_up"]])) {
					$top_up[$value["top_up"]] += 1;
				} else {
					$top_up[$value["top_up"]] = 1;
				}
				$tmp_leader_name[] = $value[$tmp];
			}
			
			foreach($data_merchant as $value){
				$date = date("d F Y",strtotime($value['created']));
				// if(!isset($merchant[$date])) {
					// foreach($tl as $val) {
						// $merchant[$date][$val] = 0;
					// }
				// }
				if(isset($merchant[$date][$value[$tmp]])) {
					$merchant[$date][$value[$tmp]] += 1;
				} else {
					$merchant[$date][$value[$tmp]] = 1;
				}
				if(isset($kategori[$value["kategori"]])) {
					$kategori[$value["kategori"]] += 1;
				} else {
					$kategori[$value["kategori"]] = 1;
				}
				$tmp_leader_name[] = $value[$tmp];
			}
			
			if(isset($tmp_leader_name) && !empty($tmp_leader_name)){
				$leader_name = array_unique($tmp_leader_name);
				sort($leader_name);
				
				foreach($leader_name as $value) {
					foreach($user as $k => $v){
						if(!isset($user[$k][$value])) $user[$k][$value] = 0;
						ksort($user[$k]);
					}
				}
				
				foreach($leader_name as $value) {
					foreach($merchant as $k => $v){
						if(!isset($merchant[$k][$value])) $merchant[$k][$value] = 0;
						ksort($merchant[$k]);
					}
				}
			}

			$data['data_user'] = $data_user;
			$data['user'] = $user;
			$data['top_up'] = $top_up;
			$data['data_merchant'] = $data_merchant;
			$data['merchant'] = $merchant;
			$data['kategori'] = $kategori;
			$data['data_tl'] = $leader_name;
			$data['start_date'] = $start_date;
			$data['end_date'] = $end_date;
			// echo "<pre>";print_r($data);die;
			echo json_encode($data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */