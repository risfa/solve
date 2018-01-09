<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Insert_spg extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
	}
	public function index()
	{
		$login = $this->admin_model->isLogin();
		if($login) {
			$this->output->set_header("Cache-Control: no-store, no-cache");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
            $this->session->set_userdata('active',4);
			$data["data_spg"] = $this->admin_model->get_all_spg($this->session->userdata("admin_id"));
			$dataContent['content'] = $this->load->view('insert_spg',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
	public function doDelete(){
		$id = $this->uri->segment(3,0);
		$this->admin_model->delete_data_spg($id);
		$this->session->set_flashdata("message",array("success","Data Deleted"));
		redirect("insert_spg/");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */