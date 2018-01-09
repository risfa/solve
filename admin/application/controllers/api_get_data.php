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
		//get content
		$event = urldecode($this->uri->segment(2,0));
		$data = array();
		$wheredata = array();
		$data_leader = array();
		$data_member = array();
		$gender = array();
		$leader_name = array();
		$total = 0;
		$pattern = "/(samsung|lesehan).*/i";
		
		$start_date = urldecode($this->uri->segment(3,0));
		$end_date = urldecode($this->uri->segment(4,0));
		$status = urldecode($this->uri->segment(5,0));
		if(strtotime($end_date) < strtotime($start_date)){
			echo "Time not valid";
		}else{
			$wheredata['event_name'] = $event;
			$wheredata['start_date'] = $start_date;
			$wheredata['end_date'] = $end_date;
			if($status == "admin") {
				// $all_member = $this->admin_model->get_data_all("ms_member","member_id","",array("event_name"=>$event));
				if(preg_match($pattern,$event)) { //event samsung & lesehan
					$leader_data = $this->admin_model->api_get_data_all("tr_penjualan",$wheredata);
					if($event == "Lesehan Enduro") $product = $this->admin_model->api_get_data_lesehan("ms_member",$wheredata);
					if($event == "Lesehan Enduro 2016") $product = $this->admin_model->api_get_data_lesehan("ms_member",$wheredata);
				} else { //default event
					$leader_data = $this->admin_model->api_get_data("tr_penjualan",$wheredata);
				}
			} else if($status == "tl") {
				// $all_member = $this->admin_model->get_data_all("ms_member","member_id","",array("event_name"=>$event,'leader_name'=>$_SESSION['username']));
				$wheredata['leader_name'] = $_SESSION['username'];
				if(preg_match($pattern,$event)) { //event samsung
					$leader_data = $this->admin_model->api_get_data_spg_all("tr_penjualan",$wheredata);
					if($event == "Lesehan Enduro") $product = $this->admin_model->api_get_data_lesehan("ms_member",$wheredata);
					if($event == "Lesehan Enduro 2016") $product = $this->admin_model->api_get_data_lesehan("ms_member",$wheredata);
				} else { //default event
					$leader_data = $this->admin_model->api_get_data_spg("tr_penjualan",$wheredata);
				}
			}
			// $counter_member = 0;
			// foreach($all_member as $value) {
				// $data_member[$counter_member]['name'] = $value['name'];
				// $data_member[$counter_member]['email'] = $value['email'];
				// $data_member[$counter_member]['ktp'] = $value['ktp'];
				// $data_member[$counter_member]['gender'] = $value['gender'];
				// $data_member[$counter_member]['phone'] = $value['phone'];
				// $data_member[$counter_member]['prize'] = $value['prize'];
				// $data_member[$counter_member]['twitter'] = $value['twitter'];
				// if($status == "admin") {
					// $data_member[$counter_member]['lokasi'] = preg_replace("/tl/","",$value['leader_name']);
				// }
				// $counter_member++;
			// }
			
			#event lesehan enduro
			$all_product = $this->admin_model->get_data_all("ms_paket","paket_id","",array("event_name"=>$event));
			// print_r($all_product);die;
			foreach($all_product as $value) {
				$data_product_name[] = $value['paket'];
			}
			$data_product = array();
			// $data_product_name = array("Aromatic","Enduro","FITOXY","JF Sulfur");
			sort($data_product_name);
			foreach($product as $value) {
				if($status == "admin"){
					$tmp_name = 'leader_name';
				} else {
					$tmp_name = 'spg_name';
				}
				$date = date("d F Y",strtotime($value['dateonly']));
				if(!isset($data_product[$date])) {
					foreach($data_product_name as $v) {
						$data_product[$date][$v] = 0;
					}
				}
				if($value['product1'] != "choose") {
					if(isset($data_product[$date][$value['product1']])) {
						$data_product[$date][$value['product1']] += 1;
					} else {
						$data_product[$date][$value['product1']] = 1;
					}
				}
				if($value['product2'] != "choose") {
					if(isset($data_product[$date][$value['product2']])) {
						$data_product[$date][$value['product2']] += 1;
					} else {
						$data_product[$date][$value['product2']] = 1;
					}
				}
			}
			
			// print_r($data_product);die;
			$data['product'] = $data_product;
			$data['product_name'] = $data_product_name;
			$data['total_product'] = count($data_product_name);
			
			#end event lesehan enduro
			
			$paket_total_harga = $this->admin_model->get_paket_total_harga("tr_penjualan",$wheredata);
			$total_gender = $this->admin_model->get_gender("tr_penjualan",$wheredata);
			
			foreach($leader_data as $value){
				if($status == "admin"){
					$tmp_name = 'leader_name';
				} else {
					$tmp_name = 'spg_name';
				}
				$date = date("d F Y",strtotime($value['dateonly']));
				if(preg_match($pattern,$event)) { //event samsung
					$tmp_leader_name[] = $value[$tmp_name];
					if($event == "Lesehan Enduro") {
						if(isset($data_leader[$date][$value[$tmp_name]])) {
							$data_leader[$date][$value[$tmp_name]] += $value['paket'];
						} else {
							$data_leader[$date][$value[$tmp_name]] = $value['paket'];
						}
					} else {
						if(isset($data_leader[$date][$value[$tmp_name]])) {
							$data_leader[$date][$value[$tmp_name]] += 1;
						} else {
							$data_leader[$date][$value[$tmp_name]] = 1;
						}
					}
				} else { //default event
					$tmp_leader_name[] = $value[$tmp_name];
					$data_leader[$date][$value[$tmp_name]] = $value['total_harga'];
				}
			}
			
			// print_r($data_leader);die;
			foreach($total_gender as $value){
				if($value["gender"]) $gender[$value['gender']] = $value['total_gender'];
			}
			if(isset($tmp_leader_name) && !empty($tmp_leader_name)){
				$leader_name = array_unique($tmp_leader_name);
				sort($leader_name);
				$total = count($leader_name);
				foreach($leader_name as $value) {
					foreach($data_leader as $k => $v){
						if(!isset($data_leader[$k][$value])) $data_leader[$k][$value] = 0;
						ksort($data_leader[$k]);
					}
				}
				
				foreach($data_leader as $k=>$v){
					$rata2 = array_sum($v)/$total;
					$data_leader[$k]['rata-rata'] = round($rata2,2);
				}
			}
			
			// echo "<pre>"; print_r($data_leader);die;
			
			// $data['all_member'] = $data_member;
			$data['leader_name'] = $leader_name;
			$data['leader_data'] = $data_leader;
			$data['paket_total_harga'] = $paket_total_harga;
			$data["total_gender"] = $gender;
			$data['total_leader'] = $total;
			echo json_encode($data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */