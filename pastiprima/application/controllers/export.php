<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report');
    }

    public function index()
    {
        $this->load->library('phpexcel');
        $status=$this->session->userdata('user_status');
        if($status=="tl"){
            $datas=$this->report->getAllDataRuffle($this->session->userdata('user_admin_id'));
        }else{
            $datas=$this->report->getAllDataRuffleAll();
        }
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'No. HP');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Produk');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Nominal');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Hadiah');
        $row=2;
        foreach ($datas as $d){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $d->nama);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $d->email);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $d->noHP);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $d->produk);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $d->nominal);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $d->hadiah);
            $row++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $filename='lucky-day-report-'.date("Y-m-d").'.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0'); //no cache
        $objWriter->save('php://output');
    }

}
