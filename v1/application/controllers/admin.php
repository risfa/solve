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
        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); // HTTP/1.0
    }

    public function index()
    {
        $data['username']=$this->session->userdata('user_username');
        $data['status']=$this->session->userdata('user_status');
        $event_id=$this->session->userdata('user_event_id');
        if($data['status']!='superuser') {
            /*
             * buat custom dashboard
             */
            switch ($event_id){
                default :
                    $data['custom_dashboard']=false;
                    $data['view_file']='';
                    $data['main_function']='';
                    break;
            }
            $template['content'] = $this->load->view('dashboard', $data, true);
            $template['username'] = $data['username'];
            $this->load->view('main', $template);
        }else{
            redirect('events');
        }
    }
    public function getCustomerTable(){
        $this->db->where('event_id',$this->session->userdata('user_event_id'));
        $event=$this->db->get("ms_events")->row();
        $customer=array();
        $no=1;
        $ruffle=$this->report->getAllDataRuffle($event->event_id,$this->session->userdata('user_user_id'));
        foreach ($ruffle as $r){
            if($event->raffle=="Y") {
                $customer[] = array($no, $r->nama, $r->email, $r->noHP, $r->hadiah, /*$r->spg_name,*/ $r->created_date);
            }else{
                $customer[] = array($no, $r->nama, $r->email, $r->noHP, $r->raffle, $r->created_date);
            }
            $no++;
        }
        echo json_encode(array('data'=>$customer));
    }
    public function getCustomerTableAll(){
        $this->db->where('event_id',$this->session->userdata('user_event_id'));
        $event=$this->db->get("ms_events")->row();
        $customer=array();
        $no=1;
        $ruffle=$this->report->getAllDataRuffleAll($event->event_id);
        foreach ($ruffle as $r){
            if($event->raffle=="Y") {
                $customer[] = array($no, $r->nama, $r->email, $r->noHP, $r->hadiah, /*$r->spg_name,*/ $r->created_date);
            }else{
                $customer[] = array($no, $r->nama, $r->email, $r->noHP, $r->raffle, $r->created_date);
            }
            $no++;
        }
        echo json_encode(array('data'=>$customer));
    }
    public function getCustomerChart(){
        $this->db->where('event_id',$this->session->userdata('user_event_id'));
        $event=$this->db->get("ms_events")->row();
        $ruffle=$this->report->getAllDataRuffle($event->event_id,$this->session->userdata('user_user_id'));
        $spg=$this->report->getAllSPG($event->event_id,$this->session->userdata('user_user_id'));
        echo json_encode(array('data'=>$ruffle,'legend'=>$spg));
    }
    public function getCustomerChartAll(){
        $this->db->where('event_id',$this->session->userdata('user_event_id'));
        $event=$this->db->get("ms_events")->row();
        $ruffle=$this->report->getAllDataRuffleAll($event->event_id);
        $spg=$this->report->getAllTL($event->event_id);
        echo json_encode(array('data'=>$ruffle,'legend'=>$spg));
    }
}
