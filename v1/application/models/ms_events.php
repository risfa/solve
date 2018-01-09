<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms_events extends CI_Model
{
    function getAllEvents()
    {
        $events = $this->db->get('ms_events');
        if ($events->num_rows() > 0) {
            return $events->result();
        } else {
            return array();
        }
    }
    function getEventFields($event_id){
        $this->db->where('event_id',$event_id);
        $this->db->order_by('field_order','asc');
        $fields=$this->db->get("ms_fields");
        if($fields->num_rows()>0){
            return $fields->result();
        }else{
            return array();
        }
    }
    function getEventInfo($event_id){
        $this->db->where('event_id',$event_id);
        $fields=$this->db->get("ms_events");
        if($fields->num_rows()>0){
            return $fields->row();
        }else{
            return array();
        }
    }
    function getAddtionalInfo($event_id){
        $this->db->where('event_id',$event_id);
        $this->db->where('role_id',"1");
        $fields=$this->db->get("user_access");
        if($fields->num_rows()>0){
           $admin_id=$fields->row()->user_id;
        }else{
            $admin_id=false;
        }
        $this->db->where('event_id',$event_id);
        $fields=$this->db->get("ms_stocks");
        if($fields->num_rows()>0){
            $prize=true;
        }else{
            $prize=false;
        }
        return array(
          'admin_id'=>$admin_id,
          'prize'=>$prize
        );
    }
    function getAllAdmin(){
        $this->db->where('created_by','0');
        $fields=$this->db->get("ms_users");
        if($fields->num_rows()>0){
            return $fields->result();
        }else{
            return array();
        }
    }
    public function saveFieldFO($data){
        $this->db->where('field_name',$data['field_name']);
        $this->db->where('event_id',$data['event_id']);
        $field=$this->db->get('ms_fields');
        if($field->num_rows()>0){
            $this->db->where('field_id',$field->row()->field_id);
            $this->db->update('ms_fields',$data);
        }else{
            $this->db->insert('ms_fields',$data);
        }
    }
    public function setAdmin($event_id,$user_id){
        $this->db->where('event_id',$event_id);
        $this->db->where('role_id','1');
        $this->db->delete('user_to_event');
        $admin=$this->db->insert('user_to_event',array(
           'user_id'=>$user_id,
           'event_id'=>$event_id,
           'role_id'=>'1'
        ));
        if($admin){
            $response['status']=true;
            $response['message']="admin has been set";
}else{
            $response['status']=false;
            $response['message']="admin failed to set";
        }
        return $response;
    }
    public function addStock($data){
        // $this->db->where('stock_date',$data['stock_date']);
        // $this->db->where('hadiah',$data['hadiah']);
        // $this->db->where('event_id',$data['event_id']);
        // $this->db->where('spg_id',$data['spg_id']);
        // $field=$this->db->get('ms_stocks');
        // if($field->num_rows()<1){
        // }
            $this->db->insert('ms_stocks',$data);
    }
}