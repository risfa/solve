<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$class['active_home'] = "class='active'";
		$dataContent = array();
		$data = array();
		if($_SESSION['status'] == "superadmin"){
			$allEvent = $this->admin_model->get_data_all("ms_event","event_id");
			$data['event'] = $allEvent;
			$dataContent['event'] = $allEvent;
		}else{
			$dataContent['event'] = $_SESSION['event'][0];
		}
		$event = urldecode($this->uri->segment(2,0));
		$dataContent['class'] = $class;
		$dataContent['status'] = $_SESSION['status'];
		$dataContent['content'] = $this->load->view('home',$data,true);
		$dataContent['event_selected'] = $event;
		if(in_array($event,$_SESSION['event'])){		
			$this->load->view('template', $dataContent);
		}else{
			$this->load->view('login');
			session_destroy();
		}
	}
	
	public function logout(){
		session_destroy();
		$this->load->view('login');
	}
	
	public function addEvent(){
		$event = array();
		$data = array();
		$prize = array();
		$event['event_name'] = $_POST['namaEvent'];
		$event['event_status'] = "aktif";
		$event['start_date'] = $_POST['startDate'];
		$event['end_date'] = $_POST['endDate'];
		$event['total_tl'] = $_POST['totalTL'];
		$event['color'] = $_POST['color'];
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data['event_name'] = $_POST['namaEvent'];
		$data['status'] = "admin";
		$prize['event_name'] = $_POST['namaEvent'];
		$data_image = array();
		$supportedFile = array("image/png", "image/jpeg");
		//image
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
		//end image
		
		$event['image'] = json_encode($data_image['new_name']);
		$this->admin_model->insert_data("ms_admin",$data);
		$this->admin_model->insert_data("ms_prize",$prize);
		list($success,$desc) = $this->admin_model->insert_data("ms_event",$event);
		if($success == "success") {
			list($desc) = $this->upload($data_image,$data['event_name']);
		}
		if($desc[0] == "danger"){
			$this->session->set_flashdata("message",array("danger","Upload Image Failed"));
		} else {
			$this->session->set_flashdata("message",array("success","Data Inserted"));
		}
		redirect("home/".$_SESSION['event'][0]);
	}
	
	public function doDelete(){
		$id = $this->uri->segment(3,0);
		$this->admin_model->delete_data("ms_event","event_id",$id);
		$this->session->set_flashdata("message",array("success","Data Deleted"));
		redirect("home/".$_SESSION['event'][0]);
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
			if(!is_dir($target_path)) mkdir($target_path,0777,TRUE);
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