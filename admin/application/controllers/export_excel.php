<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_excel extends CI_Controller {

	public function index()
	{
		$this->load->library('excel');
		$data = array();
		foreach($_POST as $key => $value) {
			$data[$key] = $value;
		}
		$event = $data['event'];
		$data['filename'] = $data['user']."_".$data['event']."_".date("Ymd",strtotime(urldecode($data['start_date'])))."_".date("Ymd",strtotime(urldecode($data['end_date']))).".xls";
		if($event == "Lesehan Enduro") {
			$this->sheet(0,$phpexcel,$data['leader_data'],$data['leader_name']);
			$this->sheet(1,$phpexcel,$data['total_gender']);
			$this->sheet(2,$phpexcel,$data['paket_total_harga']);
			$this->sheet(3,$phpexcel,$data['product'],$data['product_name']);
		} else {
			$this->sheet(0,$phpexcel,$data['leader_data'],$data['leader_name']);
			$this->sheet(1,$phpexcel,$data['total_gender']);
			$this->sheet(2,$phpexcel,$data['paket_total_harga']);
		}
		
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$data['filename'].'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		// $objWriter->save('php://output');
		$objWriter->save('/home/dapps/public_html/solve/admin/files/Lesehan Enduro/'.$data['filename']);
	}

	public function sheet($index,&$phpexcel,$data,$name = array()) {
		$this->load->library('excel');
		$start = "A";
		$counter = 1;
		$flag = true;
		
		$this->excel->createSheet();
		
		$this->excel->setActiveSheetIndex($index);
		
		if($index == 0) {
			$this->excel->getActiveSheet()->setTitle("Daily Sales");
			$this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue($start.$counter,"Date");
			$this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			$start++;
			foreach($name as $key => $value) {
				$this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($start.$counter,$value);
				$this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
					'font'=>array(
						'bold'=>true
					)
				));
				$start++;
			}
			$this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue($start.$counter,"Rata-rata");
			$this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			$start2 = "A";
			$counter += 1;
			foreach($data as $key => $value) {
				$this->excel->getActiveSheet()->setCellValue($start2.$counter,$key);
				foreach($value as $k => $v) {
					$start2++;
					$this->excel->getActiveSheet()->setCellValue($start2.$counter,$v);
				}
				$counter++;
				$start2 = "A";
			}
		} else if($index == 1) {
			$this->excel->getActiveSheet()->setTitle("Gender");
			$this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("A".$counter,"Pria");
			$this->excel->getActiveSheet()->getStyle("A".$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			
			$this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("B".$counter,"Wanita");
			$this->excel->getActiveSheet()->getStyle("B".$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			
			$start2 = "A";
			$counter += 1;
			foreach($data as $key => $value) {
				$this->excel->getActiveSheet()->setCellValue($start2.$counter,$value);
				$start2++;
			}
		} else if($index == 2) {
			$this->excel->getActiveSheet()->setTitle("Total Paket dan Harga");
			$this->excel->getActiveSheet()->getColumnDimension("A")->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("A".$counter,"Total Paket");
			$this->excel->getActiveSheet()->getStyle("A".$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			
			$this->excel->getActiveSheet()->getColumnDimension("B")->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue("B".$counter,"Harga");
			$this->excel->getActiveSheet()->getStyle("B".$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			$start2 = "A";
			$counter += 1;
			foreach($data as $key => $value) {
				foreach($value as $k => $v){
					$this->excel->getActiveSheet()->setCellValue($start2.$counter,$v);
					$start2++;
				}
			}
		} else if($index == 3) {
			$this->excel->getActiveSheet()->setTitle("Daily Sales per Product");
			$this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
			$this->excel->getActiveSheet()->setCellValue($start.$counter,"Date");
			$this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
				'font'=>array(
					'bold'=>true
				)
			));
			$start++;
			foreach($name as $key => $value) {
				$this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
				$this->excel->getActiveSheet()->setCellValue($start.$counter,$value);
				$this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
					'font'=>array(
						'bold'=>true
					)
				));
				$start++;
			}
			$start2 = "A";
			$counter += 1;
			foreach($data as $key => $value) {
				$this->excel->getActiveSheet()->setCellValue($start2.$counter,$key);
				foreach($value as $k => $v) {
					$start2++;
					$this->excel->getActiveSheet()->setCellValue($start2.$counter,$v);
				}
				$counter++;
				$start2 = "A";
			}
		}
		
		$this->excel->setActiveSheetIndex(0);
	}
}
