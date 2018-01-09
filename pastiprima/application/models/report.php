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
    function getAllDataRuffle($tl){
        $this->db->where('admin_id',$tl);
        $data=$this->db->get('report_peserta');
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
    function getAllDataRuffleAll(){
        $data=$this->db->get('report_peserta');
        if($data->num_rows()>0){
            return $data->result();
        }else{
            return array();
        }
    }
}