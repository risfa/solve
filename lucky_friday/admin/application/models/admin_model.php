<?php
class Admin_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function updateLastLogin($id,$status,$date) {
		if($status == "admin" || $status == "tl") {
			$this->db->where("admin_id",$id);
			$this->db->update("ms_admin", ["last_login" => $date]);
		} else {
			$this->db->where("spg_id",$id);
			$this->db->update("ms_spg", ["last_login" => $date]);
		}
	}
	
	public function setLogin() {
		$this->session->set_userdata("login",true);
	}
	
	public function isLogin() {
		return $this->session->userdata("login");
	}
	
	public function get_data_admin($username, $password){
		$this->db->select("admin_id, username, status");
		$this->db->from("ms_admin");
		$this->db->where("username",$username);
		$this->db->where("password",$password);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_data_tl($id){
		$this->db->select("admin_id, username, status");
		$this->db->from("ms_admin");
		$this->db->where(["admin_id" => $id]);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_all_data_tl(){
		$this->db->select("username");
		$this->db->from("ms_admin");
		$this->db->where(["status" => "tl"]);
		$this->db->order_by("admin_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_all_data_spg($id){
		$this->db->select("username");
		$this->db->from("ms_spg");
		$this->db->where(["admin_id" => $id]);
		$this->db->order_by("spg_id");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function delete_data_tl($id){
		$this->db->where(["admin_id" => $id]);
		$this->db->delete("ms_admin");
	}
	
	public function get_all_tl(){
		$this->db->select("admin_id, username, last_login");
		$this->db->from("ms_admin");
		$this->db->where(["status" => "tl"]);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert_data_tl($data){
		if($this->db->insert("ms_admin", $data)) {
			return true;
		} else {
			return false;
		}
	}
	public function cekTL($username){
			$this->db->where('username',$username);
			$user=$this->db->get("ms_admin");
			if($user->num_rows()>0) {
					return false;
			} else {
					return true;
			}
	}
	public function update_data_tl($id,$data){
		$this->db->where("admin_id",$id);
		if($this->db->update("ms_admin", $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_data_spg($id){
		$this->db->select("spg_id, username");
		$this->db->from("ms_spg");
		$this->db->where(["spg_id" => $id]);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function delete_data_spg($id){
		$this->db->where(["spg_id" => $id]);
		$this->db->update("ms_spg",array("enabled"=>"N"));
	}
	
	public function get_all_spg($tlId){
		$this->db->select("spg_id, username, last_login");
		$this->db->from("ms_spg");
		$this->db->where("admin_id",$tlId);
		$this->db->where("enabled","Y");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function insert_data_spg($data){
		if($this->db->insert("ms_spg", $data)) {
			return true;
		} else {
			return false;
		}
	}
	public function cekSpg($username){
		$this->db->where('username',$username);
		$user=$this->db->get("ms_admin");
		if($user->num_rows()>0) {
			return false;
		} else {
			return true;
		}
	}
	public function update_data_spg($id,$data){
		$this->db->where("spg_id",$id);
		if($this->db->update("ms_spg", $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function updatePassword($id, $data){
		$this->db->where("admin_id",$id);
		if($this->db->update("ms_admin", $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function checkOldPassword($id, $password){
		$this->db->where(['admin_id'=>$id, 'password'=>md5($password)]);
		$cek = $this->db->get("ms_admin");
		if($cek->num_rows>0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_data_user($id,$wheredata) {
		$this->db->select("hp,top_up,no_serial,gimmick,created,created_by,admin_name");
		$this->db->from("ms_user");
		$this->db->where($wheredata);
		$this->db->order_by("created");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_data_merchant($id,$wheredata) {
		$this->db->select("nama_toko,kategori,nama_pemilik,hp,ktp,tertarik,created,created_by,admin_name");
		$this->db->from("ms_merchant");
		$this->db->where($wheredata);
		$this->db->order_by("created");
		$query = $this->db->get();
		return $query->result_array();
	}
	
}