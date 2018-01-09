<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Model
{
    function getReportSPGperDay($tl){
        $this->db->where('admin_id',$tl);
        $this->db->group_by('admin_id');
        $this->db->group_by('date_join');
        $this->db->select('sum(jumlah) as jumlah, sum(money) as money,date_join');
        $data=$this->db->get('report_spg_per_day');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportTLperProduk($tl){
        $this->db->where('admin_id',$tl);
        $this->db->group_by('admin_id');
        $this->db->group_by('produk');
        $this->db->select('sum(jumlah) as jumlah,produk');
        $data=$this->db->get('report_spg_produk');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportTLperHadiah($tl){
        $this->db->where('admin_id',$tl);
        $this->db->group_by('admin_id');
        $this->db->group_by('hadiah');
        $this->db->select('sum(jumlah) as jumlah,hadiah');
        $data=$this->db->get('report_spg_hadiah');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportSPGSinglePerDay($tl){
        $this->db->where('admin_id',$tl);
        $this->db->select('spg_name,jumlah,money,date_join');
        $data=$this->db->get('report_spg_per_day');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getAllDataRuffle($event_id,$tl_id){
        $this->db->where('event_id',$event_id);
        $this->db->where('tl_id',$tl_id);
        $this->db->order_by('spg_name','asc');
        $data=$this->db->get('peserta_event');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportSPGperDayAll(){
        $this->db->group_by('date_join');
        $this->db->select('sum(jumlah) as jumlah, sum(money) as money,date_join');
        $data=$this->db->get('report_spg_per_day');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportTLperProdukAll(){
        $this->db->group_by('produk');
        $this->db->select('sum(jumlah) as jumlah,produk');
        $data=$this->db->get('report_spg_produk');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportTLperHadiahAll(){
        $this->db->group_by('hadiah');
        $this->db->select('sum(jumlah) as jumlah,hadiah');
        $data=$this->db->get('report_spg_hadiah');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getReportSPGSinglePerDayAll(){
        $this->db->group_by('admin_id');
        $this->db->group_by('date_join');
        $this->db->select('tl_name,sum(jumlah) as jumlah,sum(money) as money,date_join');
        $data=$this->db->get('report_spg_per_day');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getAllDataRuffleAll($event_id){
        $this->db->where('event_id',$event_id);
        $this->db->order_by('spg_name','asc');
        $data=$this->db->get('peserta_event');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getAllSPG($event_id,$tl_id){
        $data=$this->db->query('select distinct spg_name as field from peserta_event where event_id="'.$event_id.'" and tl_id="'.$tl_id.'"');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
    function getAllTL($event_id){
        $data=$this->db->query('select distinct tl_name as field from peserta_event where event_id="'.$event_id.'"');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
}