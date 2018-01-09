<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_excel extends CI_Controller {

	public function index()
	{
		$this->load->library('excel');
		$data=json_decode($_POST['data']);
		$phpexcel = new PHPExcel();
		$data->filename = uniqid()."-laporan-lucky-friday.xls";
		$this->sheet(0,$phpexcel,$data->jp_tl,"Konsumen");
		$this->sheet(1,$phpexcel,$data->tp_tl,"Konsumen (Rp.)");
		$this->sheet(2,$phpexcel,$data->jp_k,"Konsumen Berdasarkan Kendaraan");
		$this->sheet(3,$phpexcel,$data->jp_p,"Konsumen Berdasarkan Produk");
		if($_SERVER['HTTP_REFERER']=="http://5dapps.com/solve/lucky_friday/admin/admin_event_dashboard"){
            $this->sheet(4,$phpexcel,$data->j_h,"Hadiah Keluar");
            $this->rawData(5,$phpexcel,"Data Peserta");
            $this->rawDataHadiah(6,$phpexcel,"Data Hadiah");
        }else{
            $this->rawData(4,$phpexcel,"Data Peserta");
            $this->rawDataHadiah(5,$phpexcel,"Data Hadiah");
        }
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('/home/dapps/public_html/solve/lucky_friday/admin/files/'.$data->filename);
		echo $data->filename;
	}

	public function sheet($index,&$phpexcel,$data,$title="") {
		$this->load->library('excel');
		$counter = 1;
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex($index);
        $this->excel->getActiveSheet()->setTitle($title);
        $start = "A";
        foreach($data as $key => $value) {
            foreach($value as $k => $v) {
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $v);
                $start++;
            }
            $counter++;
            $start = "A";
        }
		$this->excel->setActiveSheetIndex($index);
	}
	public function rawData($index,&$phpexcel,$title="") {
        $this->load->library('excel');
        $counter = 1;
        $this->excel->createSheet();
        $this->excel->setActiveSheetIndex($index);
        $this->excel->getActiveSheet()->setTitle($title);
        $start = "A";
        $status=$this->session->userdata("status");
        if($status!="admin"){
            $this->db->where('admin_id',$this->session->userdata("admin_id"));
        }
        $query=$this->db->get('report_rawdata');
        $fields=$query->list_fields();
        $data=$query->result_array();
        foreach ($fields as $field)
        {
            $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $field);
            $start++;
        }
        $start = "A";
        $counter++;
        foreach($data as $d) {
            foreach ($fields as $field)
            {
                if($field=="noHP"){
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) "'".$d[$field]);
                }else{
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $d[$field]);
                }
                $start++;
            }
            $counter++;
            $start = "A";
        }
        $this->excel->setActiveSheetIndex($index);
    }
		
	public function rawDataHadiah($index,&$phpexcel,$title="") {
		$this->load->library('excel');
		$counter = 1;
		$this->excel->createSheet();
		$this->excel->setActiveSheetIndex($index);
		$this->excel->getActiveSheet()->setTitle($title);
		$start = "A";
		$status=$this->session->userdata("status");
		if($status!="admin"){
			$this->db->where('admin_id',$this->session->userdata("admin_id"));
		}
		
		$spbu = $this->db->query("SELECT spbu.nama, nomer, COUNT(spbu) as total FROM ms_spbu spbu JOIN ms_peserta peserta ON spbu.nomer = peserta.spbu WHERE peserta.ruffle = 'y' GROUP BY spbu")->result_array();
		$i = 0;
		foreach($spbu as $val) {
			$this->db->where("spbu",$val['nomer']);
			$this->db->select(["hadiah","jumlah_hadiah"]);
			$hadiah = $this->db->get('report_spbu')->result_array();
			$tmp = array("Samsung S7"=>0,"Kemeja Turbo"=>0,"Polo Shirt Turbo"=>0,"Voucher Belanja 50K"=>0,"Voucher BBK 100K"=>0,"Voucher BBK 10K"=>0,"Pouch"=>0);
			foreach($hadiah as $v) {
				$tmp[$v["hadiah"]] = $v["jumlah_hadiah"];
			}
			$spbu[$i]["data"] = $tmp;
			$i++;
		}
		$fields = array("SPBU","Alamat","Samsung S7","Kemeja Turbo","Polo Shirt Turbo","Voucher Belanja 50K","Voucher BBK 100K","Voucher BBK 10K","Pouch","Total");
		foreach ($fields as $field) {
			$this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $field);
			$start++;
		}
		$start = "A";
		$counter++;
		// echo "<pre>";print_r($spbu);die;
		foreach($spbu as $d) {
			$this->excel->getActiveSheet()->setCellValue($start.$counter,$d["nomer"]);
			$start++;
			$this->excel->getActiveSheet()->setCellValue($start.$counter,$d["nama"]);
			foreach($d["data"] as $k => $v) {
				$start++;
				$this->excel->getActiveSheet()->setCellValue($start.$counter,$v);
				// if($k == "Samsung S7") {
					// $this->excel->getActiveSheet()->setCellValue("C".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("C".$counter,0);
				// }
				
				// if($k == "Kemeja Turbo") {
					// $this->excel->getActiveSheet()->setCellValue("D".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("D".$counter,0);
				// }
				
				// if($k == "Polo Shirt Turbo") {
					// $this->excel->getActiveSheet()->setCellValue("E".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("E".$counter,0);
				// }
				
				// if($k == "Voucher Belanja 50K") {
					// $this->excel->getActiveSheet()->setCellValue("F".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("F".$counter,0);
				// }
				
				// if($k == "Voucher BBK 100K") {
					// $this->excel->getActiveSheet()->setCellValue("G".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("G".$counter,0);
				// }
				
				// if($k == "Voucher BBK 10K") {
					// $this->excel->getActiveSheet()->setCellValue("H".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("H".$counter,0);
				// }
				
				// if($k == "Pouch") {
					// $this->excel->getActiveSheet()->setCellValue("I".$counter,$v);
				// } else {
					// $this->excel->getActiveSheet()->setCellValue("I".$counter,0);
				// }
			}
			$start++;
			$this->excel->getActiveSheet()->setCellValue($start.$counter, $d["total"]);
			$counter++;
			$start = "A";
		}
		$this->excel->setActiveSheetIndex($index);
	}
}
