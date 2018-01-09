<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_get_data extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin_model');
		session_start();
	}

	public function index()
	{
		$status=$this->input->post('status');
		if($status=='admin'){
			$this->getReportAdmin();
		}else{
			$this->getReportTL();
		}
	}
	private function getReportTL(){
        $data=array();
        $jmlPenjualan=array(array('Nama FO','Week 1','Week 2','Week 3','Week 4'));
        $totalPenjualan=array(array('Nama FO','Week 1','Week 2','Week 3','Week 4'));
        $tmpArray=array();
        $tmpArray2=array();
        $tmpTL="";
        $this->db->where('tl_name',$this->session->userdata("username"));
        $dataTL=$this->db->get('report_spg_tl')->result();
        $no=1;
        foreach ($dataTL as $d){
            $week=$d->week;
            if($d->spg_name != $tmpTL){
                if($tmpTL!=""){
                    $no++;
                }
                $tmpArray=array();
                $tmpArray2=array();
                $tmpTL=$d->spg_name;
                $tmpArray[0]=$tmpTL;
                $tmpArray[1]=0;
                $tmpArray[2]=0;
                $tmpArray[3]=0;
                $tmpArray[4]=0;
                $tmpArray2[0]=$tmpTL;
                $tmpArray2[1]=0;
                $tmpArray2[2]=0;
                $tmpArray2[3]=0;
                $tmpArray2[4]=0;
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }else{
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }
        }
        $jmlKendaraan=array(array('Merk Kendaraan','Jumlah'));
        $jmlProduk=array(array('Nama Produk','Jumlah'));
        $this->db->where('tl_name',$this->session->userdata("username"));
        $dataKendaraan=$this->db->get('report_spg_kendaraan')->result();
        foreach ($dataKendaraan as $d){
            $jmlKendaraan[]=array($d->merk_kendaraan,(int) $d->jumlah_penjualan);
        }
        $this->db->where('tl_name',$this->session->userdata("username"));
        $dataProduk=$this->db->get('report_spg_produk')->result();
        foreach ($dataProduk as $d){
            $jmlProduk[]=array($d->produk,(int) $d->jumlah_penjualan);
        }
        $jmlPenjualan=array(array('Nama SPG','Week 1','Week 2','Week 3','Week 4'));
        $totalPenjualan=array(array('Nama SPG','Week 1','Week 2','Week 3','Week 4'));
        $tmpArray=array();
        $tmpArray2=array();
        $tmpTL="";
        $this->db->where('tl_name',$this->session->userdata("username"));
        $dataTL=$this->db->get('report_spg_tl')->result();
        $no=1;
        foreach ($dataTL as $d){
            $week=$d->week;
            if($d->spg_name != $tmpTL){
                if($tmpTL!=""){
                    $no++;
                }
                $tmpArray=array();
                $tmpArray2=array();
                $tmpTL=$d->spg_name;
                $tmpArray[0]=$tmpTL;
                $tmpArray[1]=0;
                $tmpArray[2]=0;
                $tmpArray[3]=0;
                $tmpArray[4]=0;
                $tmpArray2[0]=$tmpTL;
                $tmpArray2[1]=0;
                $tmpArray2[2]=0;
                $tmpArray2[3]=0;
                $tmpArray2[4]=0;
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }else{
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }
        }
        $data['jp_tl']=$jmlPenjualan;
        $data['tp_tl']=$totalPenjualan;
        $data['jp_k']=$jmlKendaraan;
        $data['jp_p']=$jmlProduk;
        echo json_encode($data);
    }
	private function getReportAdmin(){
        $data=array();
        $jmlPenjualan=array(array('Nama Produk','Week 1','Week 2','Week 3','Week 4'));
        $totalPenjualan=array(array('Nama Produk','Week 1','Week 2','Week 3','Week 4'));
        $tmpArray=array();
        $tmpArray2=array();
        $tmpTL="";
        $dataTL=$this->db->get('report_tl_produk_week')->result();
        $no=1;
        foreach ($dataTL as $d){
            $week=$d->week;
            if($d->produk != $tmpTL){
                if($tmpTL!=""){
                    $no++;
                }
                $tmpArray=array();
                $tmpArray2=array();
                $tmpTL=$d->produk;
                $tmpArray[0]=$tmpTL;
                $tmpArray[1]=0;
                $tmpArray[2]=0;
                $tmpArray[3]=0;
                $tmpArray[4]=0;
                $tmpArray2[0]=$tmpTL;
                $tmpArray2[1]=0;
                $tmpArray2[2]=0;
                $tmpArray2[3]=0;
                $tmpArray2[4]=0;
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }else{
                $tmpArray[$week]=(int) $d->jumlah_penjualan;
                $tmpArray2[$week]=(int) $d->total_penjualan;
                $jmlPenjualan[$no]=$tmpArray;
                $totalPenjualan[$no]=$tmpArray2;
            }
        }
        $jmlKendaraan=array(array('Merk Kendaraan','Jumlah'));
        $jmlProduk=array(array('Nama Produk','Jumlah'));
        $dataKendaraan=$this->db->get('report_tl_kendaraan')->result();
        foreach ($dataKendaraan as $d){
            $jmlKendaraan[]=array($d->merk_kendaraan,(int) $d->jumlah_penjualan);
        }
        $dataProduk=$this->db->get('report_tl_produk')->result();
        foreach ($dataProduk as $d){
            $jmlProduk[]=array($d->produk,(int) $d->jumlah_penjualan);
        }
        //=========================
        $total_hadiah=0;
        $jmlHadiah=array(array('Nama Hadiah','Week 1','Week 2','Week 3','Week 4'));
        $tmpArray=array();
        $tmpTL="";
        $dataTL=$this->db->get('report_hadiah')->result();
        $no=1;
        foreach ($dataTL as $d){
            $week=$d->minggu_ke;
            if($d->hadiah != $tmpTL){
                if($tmpTL!=""){
                    $no++;
                }
                $tmpArray=array();
                $tmpArray2=array();
                $tmpTL=$d->hadiah;
                $tmpArray[0]=$tmpTL;
                $tmpArray[1]=0;
                $tmpArray[2]=0;
                $tmpArray[3]=0;
                $tmpArray[4]=0;
                $tmpArray2[0]=$tmpTL;
                $tmpArray2[1]=0;
                $tmpArray2[2]=0;
                $tmpArray2[3]=0;
                $tmpArray2[4]=0;
                $tmpArray[$week]=(int) $d->jumlah_pemenang;
                $total_hadiah+=(int) $d->jumlah_pemenang;
                $jmlHadiah[$no]=$tmpArray;
            }else{
                $tmpArray[$week]=(int) $d->jumlah_pemenang;
                $jmlHadiah[$no]=$tmpArray;
                $total_hadiah+=(int) $d->jumlah_pemenang;
            }
        }
        $data['jp_tl']=$jmlPenjualan;
        $data['tp_tl']=$totalPenjualan;
        $data['jp_k']=$jmlKendaraan;
        $data['jp_p']=$jmlProduk;
        $data['j_h']=$jmlHadiah;
        $data['t_h']=$total_hadiah;
        echo json_encode($data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */