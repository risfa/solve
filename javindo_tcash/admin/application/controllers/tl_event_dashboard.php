<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tl_event_dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	public function index()
	{
		$login = $this->admin_model->isLogin();
		if($login) {
            $this->session->set_userdata('active',3);
			$this->output->set_header("Cache-Control: no-store, no-cache");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
			$dataContent['content'] = $this->load->view('tl_event_dashboard',array(),true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */