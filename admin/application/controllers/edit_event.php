<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_event extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
		session_start();
		if(!isset($_SESSION['username'])){
			redirect('login');
		}
	}
	public function index()
	{
		//set content
		$class = array();
		$data = array();
		$id = $this->uri->segment(2,0);
		$data_event = $this->admin_model->get_data("ms_event me JOIN ms_admin ma ON me.event_name = ma.event_name",array("event_id"=>$id,"ma.status"=>"admin"));
		$event = urldecode($this->uri->segment(3,0));
		$data['data_event'] = $data_event;
		$data['event_selected'] = $event;	
		$class['active_home'] = "class='active'";
		$dataContent = array();
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$data['event'] = $allEvent;
			$dataContent['event'] = $allEvent;
		}
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['event_selected'] = $event;
		$dataContent['content'] = $this->load->view('edit_event',$data,true);
		$this->load->view('template', $dataContent);
	}
	
	public function doEdit(){
		$event_id = $_POST['id'];
		$admin_id = $_POST['admin_id'];
		$event_before = $_POST['namaEvent'];
		$event_selected = $_POST['event'];
		$newpassword = $_POST['newpassword'];
		$event = array();
		$data = array();
		$desc = array();
		$event['event_name'] = $_POST['namaEvent'];
		$event['event_status'] = "aktif";
		$event['start_date'] = $_POST['startDate'];
		$event['end_date'] = $_POST['endDate'];
		$event['total_tl'] = $_POST['totalTL'];
		$event['color'] = $_POST['color'];
		$event['image'] = json_encode(array("banner_image"=>$_POST['beforeUpdateImage']));
		$data['username'] = $_POST['username'];
		if(empty($newpassword)){
			$data['password'] = md5($_POST['password']);
		}
		$data['event_name'] = $_POST['namaEvent'];
		$data['status'] = "admin";
		
		$data_image = array();
		$supportedFile = array("image/png", "image/jpeg");
		//image
		if(!empty($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] != "") {
			foreach($_FILES as $key => $value) {
				$data_image['name'][$key] 			= $value['name'];
				$data_image['type'][$key] 			= $value['type'];
				$data_image['tmp_name'][$key]		= $value['tmp_name'];
				$data_image['error'][$key] 			= $value['error'];
				$data_image['size'][$key] 			= $value['size'];
				$explode = explode('.',$value['name']);
				$ext = end($explode);
				$data_image['new_name'][$key] = $explode[0]."-".microtime(true).".".$ext;
				$data_image['folder'][$key] = "files/".$data['event_name']."/".$data_image['new_name'][$key];
				try {
					if($data_image['name'][$key] == "") {
						$error = "Empty image";
						throw new Exception($error);
					}
					
					if($data_image['error'][$key] == 0) {
						if(!in_array($data_image['type'][$key], $supportedFile)) {
							$error = "Invalid Image";
							throw new Exception($error);
						}
					}
				} catch(Exception $e) {
					$this->session->set_flashdata("message",array("danger",$error));
				}
				usleep(100);
			}
			$event['image'] = json_encode($data_image['new_name']);
		}
		//end image
		// echo "<pre>";
		// print_r($event);die;
		$this->admin_model->update_data("ms_admin","admin_id",$admin_id,$data);
		list($success,$desc) = $this->admin_model->update_data("ms_event","event_id",$event_id,$event);
		if($success == "success") {
			if((!empty($_FILES['banner_image']['name']) && $_FILES['banner_image']['name'] != "")) {
				list($desc) = $this->upload($data_image,$data['event_name']);
			} else if($event_before != $event_selected) {
				list($desc) = $this->upload($data_image,$event_before);
			}
		}
		if($desc[0] == "danger"){
			$this->session->set_flashdata("message",array("danger","Upload Image Failed"));
		} else {
			$this->session->set_flashdata("message",array("success","Data Inserted"));
		}
		if($event_before != $event_selected) {
			$wheredata = array();
			$data_update = array();
			$wheredata['event_name'] = $event_selected;
			$data_update['event_name'] = $event_before;
			$this->admin_model->update_data_all("ms_admin",$wheredata,$data_update);
			$this->admin_model->update_data_all("ms_member",$wheredata,$data_update);
			$this->admin_model->update_data_all("ms_spg",$wheredata,$data_update);
			$this->admin_model->update_data_all("tr_penjualan",$wheredata,$data_update);
			if($_SESSION['status'] == "superadmin"){
				unset($_SESSION['event']);
				$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
				foreach($allEvent as $k => $v){
					$_SESSION['event'][] = $v['event_name'];
				}
			}
			$this->session->set_flashdata("message",array("success","Data Inserted"));
			redirect("home/".$event_before);
		} else {		
			$this->session->set_flashdata("message",array("success","Data Inserted"));
			redirect("home/".$event_selected);
		}
	}
	
	public function upload($img,$folder){
		$j = 0; //Variable for indexing uploaded image 
		$keys = array();
		$validate = array();
		// echo "<pre>";
		// print_r($img);die;
		foreach($img['name'] as $key => $value){
			$keys[$key] = $value;
		}
		foreach ($keys as $key=>$value) {
			$target_path = getcwd()."/files/".$folder;
			if(!is_dir($target_path)) mkdir($target_path,0755,TRUE);
			$target_path = $target_path."/".$img['new_name'][$key];
			if (move_uploaded_file($img['tmp_name'][$key], $target_path)) {//if file moved to uploads folder
				$validate[] = "success";
			} else {//if file was not moved.
				$validate[] = "failed";
			}
		}
		return $validate;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */