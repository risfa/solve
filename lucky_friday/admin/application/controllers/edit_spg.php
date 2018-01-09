<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_spg extends CI_Controller {

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
			$id = $this->uri->segment(2,0);
            $this->session->set_userdata('edit_id',$id);
            $this->session->set_userdata('edit_id',$id);
			if($id == "null") {
				redirect("insert_spg","location");
				return;
			}
			$data_spg = $this->admin_model->get_data_spg($id);
			$data['data_spg'] = $data_spg;
            $data['failed'] = $this->session->flashdata("failed");
			$dataContent['content'] = $this->load->view('edit_spg',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
	public function doEdit(){
		$data = array();
		$id = $this->input->post('id');
        $password=$this->input->post("password");
        $cpassword=$this->input->post("cpassword");
        $old=$this->input->post("username_old");
		$data['username'] = $this->input->post('username');
		if($this->input->post("password")) {
			$data['password'] = md5($this->input->post("password"));
            if($password!="" && $password==$cpassword) {
                $datas = $this->admin_model->update_data_spg($id, $data);
                $this->session->set_flashdata("message", array("success", "Data Updated"));
                redirect("insert_spg/");
            }else{
                $id=$this->session->userdata('edit_id');
                $this->session->set_flashdata("message", array("danger", "Password Not Match"));
                redirect("edit_spg/".$id, "location", 302);
            }
		}else{
            $datas = $this->admin_model->update_data_spg($id, $data);
            redirect("insert_spg/");

        }

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */