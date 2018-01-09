<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_team_leader extends CI_Controller {

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
            $data['username'] = $this->session->flashdata("username_input");
            $data['failed'] = $this->session->flashdata("failed");
			$dataContent['content'] = $this->load->view('add_team_leader',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
	public function doAdd(){
	    $cpassword=md5($this->input->post('cpassword'));
        $data['username'] = $this->input->post('username');
        $data['password'] = md5($this->input->post('password'));
        $data['status'] = "tl";
        $data['created'] = date("Y-m-d H:i:s");
        $data['created_by'] = $this->session->userdata("username");
        $check=$this->admin_model->cekTL($data['username']);
        if($cpassword!=$data['password']){
            $this->session->set_flashdata("failed", "Password Not Match");
            $this->session->set_flashdata("username_input", $data['username']);
            redirect("add_team_leader", "location", 302);
        }else {
            if ($check) {
                $result = $this->admin_model->insert_data_tl($data);
                if ($result) {
                    $this->session->set_flashdata("message", array("success", "Data Inserted"));
                } else {
                    $this->session->set_flashdata("message", array("failed", "Failed Insert Data"));
                }
            } else {
                $this->session->set_flashdata("message", array("danger", "User Already Exist or Ever Used"));
                $this->session->set_flashdata("username_input", $data['username']);
                redirect("add_team_leader", "location", 302);
            }
            redirect("insert_team_leader", "location", 302);
        }
	}
	
	public function doDelete() {
		$id = $this->uri->segment(3,0);
		$this->admin_model->delete_data_tl($id);
		$this->session->set_flashdata("message",array("success","Data Deleted"));
		redirect("insert_team_leader","location");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */