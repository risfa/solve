<?php
class Admin_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_data_all($tablename = "", $orderby = "", $ordersort = "asc", $wheredata = array()){
		$this->db->select("*");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$this->db->order_by($orderby, $ordersort);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_count_data($tablename = "",$wheredata = array()){
		foreach($wheredata as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$this->db->from($tablename);
		return $this->db->count_all_results();
	}
	
	public function get_data($tablename = "", $wheredata = array()){
		$this->db->select("*");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			$this->db->where($key, $value);
		}
		$query = $this->db->get();
		
		return $query->row_array();
	}
	
	public function insert_data($tablename = "", $data = array()){
		if(trim($tablename)!="" && !empty($data))
		{
			$this->db->insert($tablename, $data); 
		}
		return array("success", "Insert Data Berhasil");
	}
	
	public function update_data($tablename = "", $primarykey = "", $pkvalue = "", $data = array()){
		if(trim($tablename)!="" && trim($primarykey)!="" && trim($pkvalue)!="" && !empty($data)){
			$this->db->where($primarykey, $pkvalue);
			$this->db->update($tablename, $data);
			return array("success", "Update Data Berhasil!");
		}

		return array("error","Terdapat Kesalahan dalam Sistem!");
	}
	
	public function update_data_all($tablename = "", $wheredata = array(), $data = array()){
		if(trim($tablename)!="" && !empty($wheredata) && !empty($data)){
			foreach($wheredata as $key => $value)
			{
				$this->db->where($key, $value);
			}
			$this->db->update($tablename, $data);
			return array("success", "Update Data Berhasil!");
		}

		return array("error","Terdapat Kesalahan dalam Sistem!");
	}
	
	public function delete_data($tablename = "", $primarykey = "", $pkvalue = ""){
		if(trim($tablename)!="" && trim($primarykey)!="" && trim($pkvalue)!=""){
			$this->db->where($primarykey, $pkvalue);
			$this->db->delete($tablename);
			return array("success", "Delete Berhasil");
		}

		return array("error","empty id");
	}
	
	public function api_get_data($tablename = "", $wheredata = array()){
		$this->db->select("DATE(date) AS dateonly, SUM(harga) AS total_harga, leader_name");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		$this->db->group_by(array('dateonly','leader_name'));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function api_get_data_all($tablename = "", $wheredata = array()){
		$this->db->select("DATE(date) AS dateonly, leader_name, paket");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		// $this->db->group_by(array('dateonly','leader_name'));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function api_get_data_spg($tablename = "", $wheredata = array()){
		$this->db->select("DATE(date) AS dateonly, SUM(harga) AS total_harga, spg_name");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		$this->db->group_by(array('dateonly','spg_name'));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function api_get_data_spg_all($tablename = "", $wheredata = array()){
		$this->db->select("DATE(date) AS dateonly, spg_name, paket");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		// $this->db->group_by(array('dateonly','spg_name'));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_paket_total_harga($tablename = "",$wheredata = array()){
		$this->db->select("sum(paket) as total_paket, sum(harga) as total_harga");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_gender($tablename = "",$wheredata = array()){
		$this->db->select("COUNT(gender) AS total_gender, gender");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("date >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("date <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		$this->db->group_by('gender');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	#function khusus untuk event lesehan enduro
	public function api_get_data_lesehan($tablename = "",$wheredata = array()) {
		$this->db->select("DATE(created) AS dateonly, leader_name, product1, product2");
		$this->db->from($tablename);
		foreach($wheredata as $key => $value)
		{
			if($key == "start_date") {
				$this->db->where("created >=",$value." 00:00:00");
			} else if($key == "end_date") {
				$this->db->where("created <=",$value." 23:59:59");
			} else {
				$this->db->where($key, $value);
			}
		}
		// $this->db->group_by(array('dateonly','leader_name'));
		$query = $this->db->get();
		
		return $query->result_array();
	}
	#end function khusus untuk event lesehan enduro
}