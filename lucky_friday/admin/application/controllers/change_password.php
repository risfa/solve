<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_password extends CI_Controller {

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
			$id = $this->session->userdata("admin_id");
			$data_tl = $this->admin_model->get_data_tl($id);
			$data['data_tl'] = $data_tl;
			$dataContent['content'] = $this->load->view('change_password',$data,true);
			$this->load->view('template', $dataContent);
		} else {
			redirect("/login/logout");
		}
	}

	public function doChangePassword(){
		$id = $this->input->post('id');
		$oldPassword = $this->input->post('oPassword');
		if($this->admin_model->checkOldPassword($id,$oldPassword)) {
			$newPassword = $this->input->post('nPassword');
			$cnPassword = $this->input->post('cnPassword');	
			if($newPassword == $cnPassword) {
				$data["password"] = md5($newPassword);
				$datas = $this->admin_model->updatePassword($id,$data);
				$this->session->set_flashdata("message",array("success","Data Updated"));
				redirect("change_password/","location");				
			} else {
				$this->session->set_flashdata("message",array("danger","New password doesn't match"));
				redirect("change_password/","location");
			}
		} else {
			$this->session->set_flashdata("message",array("danger","Incorect old password"));
			redirect("change_password","location");
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */