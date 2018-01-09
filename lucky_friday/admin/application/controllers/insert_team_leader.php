<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_team_leader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	public function index()
	{
		$login = $this->admin_model->isLogin();
		if($login) {
			$this->session->set_userdata('active',2);
			$this->output->set_header("Cache-Control: no-store, no-cache");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			$data["all_tl"] = $this->admin_model->get_all_tl();
			$dataContent['content'] = $this->load->view('insert_team_leader',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */