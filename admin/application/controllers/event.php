<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		session_start();
		if(!isset($_SESSION['username'])){
			redirect('login');
		}
	}
	public function index()
	{
		//set content
		$dataContent = array();
		//print_r($_SESSION['event']);
		$data["dashboard_title"] = "Overview";
		$this->load->view('event', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */