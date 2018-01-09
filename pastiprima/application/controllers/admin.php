<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report');
        $login=$this->session->userdata('is_login');
        if(empty($login) || $login!=true){
                redirect('login');
        }
    }

    public function index()
    {

        $data['username']=$this->session->userdata('user_username');
        $data['status']=$this->session->userdata('user_status');
        if($data['status']=="tl"){
            $spg=$this->report->getReportSPGperDay($this->session->userdata('user_admin_id'));
            $spgSingle=$this->report->getReportSPGSinglePerDay($this->session->userdata('user_admin_id'));
            $produk=$this->report->getReportTLperProduk($this->session->userdata('user_admin_id'));
            $hadiah=$this->report->getReportTLperHadiah($this->session->userdata('user_admin_id'));
            //report spg
            $arrayDate=array();
            $arrayDataJml=array();
            $arrayDataMoney=array();
            foreach ($spg as $s){
                $arrayDate[]=$s->date_join;
                $arrayDataJml[]=$s->jumlah;
                $arrayDataMoney[]=$s->money;
            }
            //report produk
            $arrayDataProduk=array();
            $arrayDataLegendProduk=array();
            foreach ($produk as $p){
                $arrayDataProduk[]=array(
                    'name'=>$p->produk,
                    'value'=>$p->jumlah
                );
                $arrayDataLegendProduk[]=$p->produk;
            }
            //report hadiah
            $arrayDatahadiah=array();
            $arrayDataLegendHadiah=array();
            foreach ($hadiah as $p){
                $arrayDatahadiah[]=array(
                    'name'=>$p->hadiah,
                    'value'=>$p->jumlah
                );
                $arrayDataLegendHadiah[]=$p->hadiah;
            }
            //report spg alone
            $arrayDataJmlSPG=array();
            foreach ($spgSingle as $s){
                $currentSPG=$s->spg_name;
                $arrayDataJmlSPG[$currentSPG][]=$s->jumlah;
            }
            $arrayDataJmlSPGFinal=array();
            foreach ($arrayDataJmlSPG as $k=>$val){
                $arrayDataJmlSPGFinal[]=array(
                  "name"=>$k,
                  "type"=>"bar",
                  "data"=>$val
                );
            }
            $data['spg_sum_date']=$arrayDate;
            $data['spg_sum_jml']=$arrayDataJml;
            $data['spg_sum_money']=$arrayDataMoney;
            $data['spg_produk']=$arrayDataProduk;
            $data['spg_produk_legend']=$arrayDataLegendProduk;
            $data['spg_hadiah']=$arrayDatahadiah;
            $data['spg_hadiah_legend']=$arrayDataLegendHadiah;
            $data['spg_sum_jml_single']=$arrayDataJmlSPGFinal;
        }else{
            $spg=$this->report->getReportSPGperDayAll();
            $spgSingle=$this->report->getReportSPGSinglePerDayAll();
            $produk=$this->report->getReportTLperProdukAll();
            $hadiah=$this->report->getReportTLperHadiahAll();
            //report spg
            $arrayDate=array();
            $arrayDataJml=array();
            $arrayDataMoney=array();
            foreach ($spg as $s){
                $arrayDate[]=$s->date_join;
                $arrayDataJml[]=$s->jumlah;
                $arrayDataMoney[]=$s->money;
            }
            //report produk
            $arrayDataProduk=array();
            $arrayDataLegendProduk=array();
            foreach ($produk as $p){
                $arrayDataProduk[]=array(
                    'name'=>$p->produk,
                    'value'=>$p->jumlah
                );
                $arrayDataLegendProduk[]=$p->produk;
            }
            //report hadiah
            $arrayDatahadiah=array();
            $arrayDataLegendHadiah=array();
            foreach ($hadiah as $p){
                $arrayDatahadiah[]=array(
                    'name'=>$p->hadiah,
                    'value'=>$p->jumlah
                );
                $arrayDataLegendHadiah[]=$p->hadiah;
            }
            //report spg alone
            $arrayDataJmlSPG=array();
            foreach ($spgSingle as $s){
                $currentSPG=$s->tl_name;
                $arrayDataJmlSPG[$currentSPG][]=$s->jumlah;
            }
            $arrayDataJmlSPGFinal=array();
            foreach ($arrayDataJmlSPG as $k=>$val){
                $arrayDataJmlSPGFinal[]=array(
                    "name"=>$k,
                    "type"=>"bar",
                    "data"=>$val
                );
            }
            $data['spg_sum_date']=$arrayDate;
            $data['spg_sum_jml']=$arrayDataJml;
            $data['spg_sum_money']=$arrayDataMoney;
            $data['spg_produk']=$arrayDataProduk;
            $data['spg_produk_legend']=$arrayDataLegendProduk;
            $data['spg_hadiah']=$arrayDatahadiah;
            $data['spg_hadiah_legend']=$arrayDataLegendHadiah;
            $data['spg_sum_jml_single']=$arrayDataJmlSPGFinal;
        }
        $template['content']=$this->load->view('dashboard',$data,true);
        $template['username']=$data['username'];
        $this->load->view('main',$template);
    }
    function getRuffleTable(){
        $customer=array();
        $no=1;
        $ruffle=$this->report->getAllDataRuffle($this->session->userdata('user_admin_id'));
        foreach ($ruffle as $r){
            $customer[]=array($no,$r->nama,$r->email,$r->noHP,$r->hadiah,$r->date_join);
            $no++;
        }
        echo json_encode(array('data'=>$customer));
    }
    function getRuffleTableAll(){
        $customer=array();
        $no=1;
        $ruffle=$this->report->getAllDataRuffleAll();
        foreach ($ruffle as $r){
            $customer[]=array($no,$r->nama,$r->email,$r->noHP,$r->hadiah,$r->date_join);
            $no++;
        }
        echo json_encode(array('data'=>$customer));
    }
}
