<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_event_dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	public function index()
	{
		$login = $this->admin_model->isLogin();
		if($login) {
			$this->session->set_userdata('active',1);
			$this->output->set_header("Cache-Control: no-store, no-cache");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			$data["peserta"] = $this->db->get('report_rawdata')->result();
			$spbu = $this->db->query("SELECT spbu.nama, nomer, COUNT(spbu) as total FROM ms_spbu spbu JOIN ms_peserta peserta ON spbu.nomer = peserta.spbu WHERE peserta.ruffle = 'y' GROUP BY spbu")->result_array();
			$i = 0;
			foreach($spbu as $val) {
				$this->db->where("spbu",$val['nomer']);
				$spbu[$i]["data"] = $this->db->get('report_spbu')->result_array();
				$i++;
			}
			$data["spbu"] = json_encode($spbu);
			$dataContent["content"] = $this->load->view('admin_event_dashboard',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */