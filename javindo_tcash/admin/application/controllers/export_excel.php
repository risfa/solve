<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_excel extends CI_Controller {

	public function index()
	{
		$this->load->library('excel');
		$data=json_decode($_POST['data']);
        $phpexcel = new PHPExcel();
        $data->filename = uniqid()."-".date("Ymd",strtotime(urldecode($data->start_date)))."_".date("Ymd",strtotime(urldecode($data->end_date))).".xls";
		$this->sheet(0,$phpexcel,$data->data_user);
		$this->sheet(1,$phpexcel,$data->data_merchant);
		$this->sheet(2,$phpexcel,$data->merchant);
		$this->sheet(3,$phpexcel,$data->user);
		$this->sheet(4,$phpexcel,$data->top_up);
		$this->sheet(5,$phpexcel,$data->kategori);
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('/home/dapps/public_html/solve/javindo_tcash/admin/files/'.$data->filename);
		echo $data->filename;
	}

	public function sheet($index,&$phpexcel,$data,$name = array()) {
//	    var_dump($data);
//	    var_dump($name);die;
		$this->load->library('excel');
		$start = "A";
		$counter = 1;
		$flag = true;
		
		$this->excel->createSheet();
		
		$this->excel->setActiveSheetIndex($index);
		
		if($index == 0) {
			$this->excel->getActiveSheet()->setTitle("Data User");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO HP.");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TOP UP");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(40);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"SERIAL STICKER");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"GIMMICK");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TANGGAL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"SPG");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $start = "A";
			$counter += 1;
			foreach($data as $key => $value) {
				$this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key+1);
				foreach($value as $k => $v) {
                    $start++;
					if($k=='gimmick'){
					    $v=($v==1)? 'Y' : 'N';
                    }
                    if($k=='hp'){
                        $v="'".$v;
                    }
					$this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $v);
				}
				$counter++;
                $start = "A";
			}
		}else if($index==1){
            $start = "A";
            $this->excel->getActiveSheet()->setTitle("Data Merchant");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO.");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NAMA TOKO");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(15);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"KATEGORI");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NAMA PEMILIK");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO. HP");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO. KTP");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TERTARIK");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TANGGAL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"SPG");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $start = "A";
            $counter += 1;
            foreach($data as $key => $value) {
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key+1);
                foreach($value as $k => $v) {
                    $start++;
                    if($k=='tertarik'){
                        $v=($v==1)? 'Y' : 'N';
                    }
                    if($k=='hp'){
                        $v="'".$v;
                    }
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $v);
                }
                $counter++;
                $start = "A";
            }
        }else if($index==2){
            $start = "A";
            $this->excel->getActiveSheet()->setTitle("Merchant By TL");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO.");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TANGGAL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(15);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NAMA TL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"JUMLAH");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $counter += 1;
            $no=1;
            foreach($data as $key => $value) {
                foreach($value as $k => $v) {
                    $start = "A";
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $no);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $k);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $v);
                    $start++;
                    $no++;
                }
                $counter++;
                $start = "A";
            }
        }else if($index==3){
            $start = "A";
            $this->excel->getActiveSheet()->setTitle("Users By TL");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(10);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NO.");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"TANGGAL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(15);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NAMA TL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"JUMLAH");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $counter += 1;
            $no=1;
            foreach($data as $key => $value) {
                foreach($value as $k => $v) {
                    $start = "A";
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $no);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $k);
                    $start++;
                    $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $v);
                    $start++;
                    $no++;
                }
                $counter++;
                $start = "A";
            }
        }else if($index==4){
            $start = "A";
            $this->excel->getActiveSheet()->setTitle("Top Up");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"NOMINAL");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"JUMLAH");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start="A";
            $counter += 1;
            $no=1;
            foreach($data as $key => $value) {
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key);
                $start++;
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $value);
                $start++;
                $counter++;
                $start = "A";
            }
        }else if($index==5){
            $start = "A";
            $this->excel->getActiveSheet()->setTitle("Kategori Merchant");
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"KATEGORI");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start++;
            $this->excel->getActiveSheet()->getColumnDimension($start)->setWidth(20);
            $this->excel->getActiveSheet()->setCellValue($start.$counter,"JUMLAH");
            $this->excel->getActiveSheet()->getStyle($start.$counter)->applyFromArray(array(
                'font'=>array(
                    'bold'=>true
                )
            ));
            $start="A";
            $counter += 1;
            $no=1;
            foreach($data as $key => $value) {
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $key);
                $start++;
                $this->excel->getActiveSheet()->setCellValue($start.$counter,(string) $value);
                $start++;
                $counter++;
                $start = "A";
            }
        }
		$this->excel->setActiveSheetIndex($index);
	}
}
