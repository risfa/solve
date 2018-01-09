<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        /*
         * check session login
         */
        $login=$this->session->userdata('is_login');
        if(empty($login) || $login!=true){
            /*
           * jika login kosong/false maka direct ke halaman login
           */
            redirect('login');
        }
        $this->load->library('grocery_CRUD');
        $this->load->model('ms_events');
        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); // HTTP/1.0

    }

    public function index(){
        $data['username']=$this->session->userdata('user_username');
        $data['status']=$this->session->userdata('user_status');
        $data['events']=$this->ms_events->getAllEvents();
        $data['admins']=$this->ms_events->getAllAdmin();
        $template['content']=$this->load->view('manage_admin',$data,true);
        $template['username']=$data['username'];
        $this->load->view('main',$template);
    }
    public function getInfoEvent($event_id){
        $fields=$this->ms_events->getEventInfo($event_id);
        $response['data']=$fields;
        $response['status']=true;
        echo json_encode($response);
    }
    public function getAddtionalInfo($event_id){
        $data=$this->ms_events->getAddtionalInfo($event_id);
        $response['data']=$data;
        $response['status']=true;
        echo json_encode($response);
    }
    public function setAdmin($event_id,$user_id){
        $response=$this->ms_events->setAdmin($event_id,$user_id);
        echo json_encode($response);
    }
    public function generateStock(){
        /*
        * load lib validation
        */
        $this->load->library('form_validation');
        /*
         * set rules for validation
         */
        $this->form_validation->set_rules('prize[]', 'Prize Name', 'trim|required');
        $this->form_validation->set_rules('total[]', 'Total Prize', 'trim|required');
        /*
         * if true than continue process save
         */
        if ($this->form_validation->run() != FALSE) {
            $prize=$this->input->post('prize');
            $total=$this->input->post('total');
            $event_id=$this->input->post('event_id');
            $info=$this->ms_events->getEventInfo($event_id);
            $date=$info->event_start;
            $end=$info->event_end;
            if($info->stock_type=='global'){
                for ($i=0;$i<count($prize);$i++){
                    $data=array(
                      'stock_date'=>'0000-00-00',
                      'hadiah'=>$prize[$i],
                      'total'=>$total[$i],
                      'event_id'=>$event_id,
                      'spg_id'=>'0'
                    );
                    $this->ms_events->addStock($data);
                }
            }else if($info->stock_type=='daily-per-spg'){
                // $this->db->where('event_id',$event_id);
                // $this->db->where('role_id','4');
                // $spg=$this->db->get('user_access');
                // foreach ($spg->result() as $s){
                //     $beginT = new DateTime($date);
                //     $endT   = new DateTime($end);
                //     for($t = $beginT; $t <= $endT; $t->modify('+1 day')){
                //         for ($i=0;$i<count($prize);$i++){
                //                 $data=array(
                //                     'stock_date'=> $t->format("Y-m-d"),
                //                     'hadiah'=>$prize[$i],
                //                     'total'=>$total[$i],
                //                     'event_id'=>$event_id,
                //                     'spg_id'=>$s->user_id
                //                 );
                //                 $this->ms_events->addStock($data);
                //         }
                //     }
                // }
                $this->db->where('event_id',$event_id);
                $this->db->where('role_id','4');
                $spg=$this->db->get('user_access');
                foreach ($spg->result() as $s){
                    $beginT = new DateTime($date);
                    $endT   = new DateTime($end);

                    $start_date = date_format($beginT, 'Y-m-d');
                    $end_date = date_format($endT, 'Y-m-d');
                    while (strtotime($start_date) <= strtotime($end_date)) {
                        for ($i=0;$i<count($prize);$i++){
                                $data=array(
                                    'stock_date'=> $start_date,
                                    'hadiah'=>$prize[$i],
                                    'total'=>$total[$i],
                                    'event_id'=>$event_id,
                                    'spg_id'=>$s->user_id
                                );
                                $this->ms_events->addStock($data);
                        }
                        $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                    }
                }
            }else if($info->stock_type=='global-per-spg'){
                $this->db->where('event_id',$event_id);
                $this->db->where('role_id','4');
                $spg=$this->db->get('user_access');
                foreach ($spg->result() as $s){
                    for ($i=0;$i<count($prize);$i++){
                        $data=array(
                            'stock_date'=> '0000-00-00',
                            'hadiah'=>$prize[$i],
                            'total'=>$total[$i],
                            'event_id'=>$event_id,
                            'spg_id'=>$s->user_id
                        );
                        $this->ms_events->addStock($data);
                    }
                }
            }else{
				$this->db->where('event_id',$event_id);
                $this->db->where('role_id','4');
                $spg=$this->db->get('user_access');
                foreach ($spg->result() as $s){
                    $beginT = new DateTime($date);
                    $endT   = new DateTime($end);

                    $start_date = date_format($beginT, 'Y-m-d');
                    $end_date = date_format($endT, 'Y-m-d');
                    while (strtotime($start_date) <= strtotime($end_date)) {
                        for ($i=0;$i<count($prize);$i++){
                                $data=array(
                                    'stock_date'=> $start_date,
                                    'hadiah'=>$prize[$i],
                                    'total'=>$total[$i],
                                    'event_id'=>$event_id,
                                    'spg_id'=>$s->user_id
                                );
                                $this->ms_events->addStock($data);
                        }
                        $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                    }
                }
            }


            // //NEW
            //     $this->db->where('event_id',$event_id);
            //     $this->db->where('role_id','4');
            //     $spg=$this->db->get('user_access');
            //     foreach ($spg->result() as $s){
            //         $beginT = new DateTime($date);
            //         $endT   = new DateTime($end);

            //         $start_date = date_format($beginT, 'Y-m-d');
            //         $end_date = date_format($endT, 'Y-m-d');
            //         // for($t = $beginT; $t <= $endT; $t->modify('+1 day')){
            //         // while (strtotime($startdate) <= strtotime($enddate)) {
            //         while (strtotime($start_date) <= strtotime($end_date)) {
            //         // for($jby=0;$jby<10;$jby++){
            //             for ($i=0;$i<count($prize);$i++){
            //                     $data=array(
            //                         'stock_date'=> $start_date,
            //                         'hadiah'=>$prize[$i],
            //                         'total'=>$total[$i],
            //                         'event_id'=>$event_id,
            //                         'spg_id'=>$s->user_id
            //                     );
            //                    	// print_r($data)."<br>";
            //                     // foreach($data as $dt){
            //                     // 	echo $dt."<br>";
            //                     // }
            //                     $this->ms_events->addStock($data);
            //                     // echo "<hr>";
            //             }
            //             $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
            //         }
            //         // }
            //     }

                

            // //END
            $response['status']=true;
            $response['message']="stock saved";
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
}
