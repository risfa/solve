<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_spg extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("admin_model");
	}
	public function index()
	{
		$login = $this->admin_model->isLogin();
		if($login) {
            $this->session->set_userdata('active',4);
			$this->output->set_header("Cache-Control: no-store, no-cache");
			$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
			$this->output->set_header("Pragma: no-cache");
            $data['username'] = $this->session->flashdata("username_input");
            $data['failed'] = $this->session->flashdata("failed");
			$dataContent['content'] = $this->load->view('add_spg',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
	public function doAdd(){
        $cpassword=md5($this->input->post('cpassword'));
		$data['admin_id'] = $this->session->userdata("admin_id");
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['created'] = date("Y-m-d H:i:s");
		$data['created_by'] = $this->session->userdata("username");
		$check=$this->admin_model->cekSpg($data['username']);
        if($cpassword!=$data['password']){
            $this->session->set_flashdata("message", "Password Not Match");
            $this->session->set_flashdata("username_input", $data['username']);
            redirect("add_spg", "location", 302);
        }else {
            if ($check) {
                $datas = $this->admin_model->insert_data_spg($data);
                if ($datas) {
                    $this->session->set_flashdata("message", array("success", "Data Inserted"));
                } else {
                    $this->session->set_flashdata("message", array("danger", "Failed Insert Data"));
                }
            } else {
                $this->session->set_flashdata("message", array("danger", "User Already Exist or Ever Used"));
                $this->session->set_flashdata("username_input", $data['username']);
                redirect("add_spg", "location", 302);
            }
            redirect("insert_spg/", "location", 302);
        }
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */