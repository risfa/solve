<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_team_leader extends CI_Controller {

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
			$id = $this->uri->segment(2,0);
			$this->session->set_userdata('edit_id',$id);
			if($id == "null") {
				redirect("insert_team_leader","location");
				return;
			}
			$data_tl = $this->admin_model->get_data_tl($id);
			$data['data_tl'] = $data_tl;
            $data['failed'] = $this->session->flashdata("failed");
			$dataContent['content'] = $this->load->view('edit_team_leader',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}
	
	public function doEdit(){
		$id = $this->input->post('id');
		$password=$this->input->post("password");
		$cpassword=$this->input->post("cpassword");
		$old=$this->input->post("username_old");
		$data['username'] = $this->input->post('username');
		if($password!="") {
			$data['password'] = md5($this->input->post('password'));
            if($password!="" && $password==$cpassword){
                $datas = $this->admin_model->update_data_tl($id, $data);
                $this->db->query("update ms_spg set created_by='".$data['username']."' where created_by='".$old."' ");
                $this->db->query("update ms_user set admin_name='".$data['username']."' where admin_name='".$old."' ");
                $this->db->query("update ms_merchant set admin_name='".$data['username']."' where admin_name='".$old."' ");
                $this->session->set_flashdata("message", array("success", "Data Updated"));
                redirect("insert_team_leader/", "location");
            }else {
                $id=$this->session->userdata('edit_id');
                $this->session->set_flashdata("failed", "Password Not Match");
                redirect("edit_team_leader/".$id, "location", 302);
            }
		}else{
            $datas = $this->admin_model->update_data_tl($id, $data);
            $this->db->query("update ms_spg set created_by='".$data['username']."' where created_by='".$old."' ");
            $this->db->query("update ms_user set admin_name='".$data['username']."' where admin_name='".$old."' ");
            $this->db->query("update ms_merchant set admin_name='".$data['username']."' where admin_name='".$old."' ");
            $this->session->set_flashdata("message", array("success", "Data Updated"));
            redirect("insert_team_leader/", "location");

        }

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */