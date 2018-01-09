<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report');
        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); // HTTP/1.0

    }

    public function index()
    {
        $this->load->library('phpexcel');
        $status=$this->session->userdata('user_status');
        if($status=="tl"){
            $datas=$this->report->getAllDataRuffle($this->session->userdata('user_event_id'),$this->session->userdata('user_user_id'));
        }else{
            $datas=$this->report->getAllDataRuffleAll($this->session->userdata('user_event_id'));
        }
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Email');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'No. HP');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Produk');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Hadiah');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tanggal');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'SPG');
        switch($this->session->userdata('user_event_id')) {
            default :
                $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Other');
                break;
            case 2 :
                $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Nominal');
                $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Tenant');
                break;
        }
        $row=2;
        foreach ($datas as $d){
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $d->nama);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $d->email);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $d->noHP);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $d->produk);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $d->hadiah);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $d->date_event);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $d->spg_name);
            $others=json_decode( $d->others);
            switch($this->session->userdata('user_event_id')) {
                default :
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $d->others);
                    break;
                case 2 :
                    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $others->nominal);
                    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $others->tenant);
                    break;
            }
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
