<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache"); // HTTP/1.0
    }

    public function index()
    {

    }
    public function event(){
        $event=$this->db->get('ms_events');
        if($event->num_rows()>0){
            $event=$event->result();
        }else{
            $event=array();
        }
        $response['status']=true;
        $response['data']=$event;
        echo json_encode($response);
    }
    public function login(){
        $this->load->library('form_validation'); // meload library untuk validasi field
        //=========RULES VALIDATION=====
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('event_id', 'Event', 'trim|required');
        /*
         * jika data valid masukan data
         */
        if ($this->form_validation->run() != FALSE) {
            //stor data spg
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $event_id = $this->input->post('event_id');
            /*
             * get data spg by username and password
             */
            $this->db->where("username",$username);
            $this->db->where("password",$password);
            $this->db->where("event_id",$event_id);
            $this->db->where("role_id",'4');
            $this->db->select('user_access.*,user_access.user_id as spg_id');
            $spg=$this->db->get('user_access');
            //if result > 0
            if($spg->num_rows()>0){
                $response['status']=true;
                $response['message']="Login success";
                $response['data']=$spg->row();
                $this->db->where('event_id',$response['data']->event_id);
                $this->db->order_by('field_order','asc');
                $response['data']->form=$this->db->get('ms_fields')->result();
            }else{
                $response['status']=false;
                $response['message']="Invalid username and password";
            }
        }else{
            /*
             * return validation error and remove html tags error
             */
            $response['status']=false;
            $response['message']=strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    public function save(){
        $this->load->library('form_validation'); // load library validation
        $this->db->where('event_id',$this->input->post('event_id'));
        $fields=$this->db->get("ms_fields")->result();
        $this->db->where('event_id',$this->input->post('event_id'));
        $event=$this->db->get("ms_events")->row();
        /*
         * ==============LOAD RULES FOR PERSERTA==================
         */
        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
        /*
         * if send post email you have to validate email
         */
        if(isset($_POST['email']) and $_POST['email']!="" ){
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        }
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        foreach ($fields as $f){
            $c=$f->field_name;
            if($c!="fullname" && $c!="email" && $c!="phone" && $c!="product" && $c!="event_id" && $c!="spg_id") {
                $this->form_validation->set_rules($f->field_name, $f->field_placeholder, 'trim|required');
            }
        }
        /*
         * UNTUK PATOKAN VALIDASI
         */
        switch ($this->input->post('event_id')){
            /*
             * serambi
             */
            case 2 :
                $tenant=$this->input->post('tenant');
                $_POST['nominal']=(int) $_POST['nominal'];
                if($tenant=="dex" || $tenant=="dexlite" || $tenant=="pertamax" || $tenant=="pertamax turbo"){
                    $this->form_validation->set_rules("nominal", "Nominal Pembelian", 'trim|required|greater_than[199999]');
                }else if($tenant=="indosat"){
                    $this->form_validation->set_rules("nominal", "Nominal Pembelian", 'trim|required|greater_than[49999]');
                }else if($tenant=="hansaplast"){
                    $this->form_validation->set_rules("nominal", "Nominal Pembelian", 'trim|required|greater_than[39999]');
                }else{
                    $this->form_validation->set_rules("nominal", "Nominal Pembelian", 'trim|required|greater_than[99999]');
                }
                break;
        }
        /*
         * if all data send is valid continue
         */
        if ($this->form_validation->run() != FALSE) {
            /*
             * check if peserta is already participated
             */
            $this->db->where("noHP",$this->input->post('phone'));
            $this->db->where("event_id",$this->input->post('event_id'));
            $check=$this->db->get("ms_data");
            if($check->num_rows()>0){
                /*
                 * return notice
                 */
                $response['status'] = false;
                $response['message'] = "You have participated this event.";
            }else {
                $data = array(
                    'nama' => $this->input->post('fullname'),
                    'email' => $this->input->post('email'),
                    'noHP' => $this->input->post('phone'),
                    'produk' => $this->input->post('product'),
                    'event_id' => $this->input->post('event_id'),
                    'created_by' => $this->input->post('spg_id'),
                    'created_date'=>date('Y-m-d H:i:s')
                );
                $others=array();
                foreach ($fields as $f){
                    $c=$f->field_name;
                    if($c!="fullname" && $c!="email" && $c!="phone" && $c!="product" && $c!="event_id" && $c!="spg_id"){
                        $others[$c]=$this->input->post($c);
                    }
                }
                $data['others']=json_encode($others);
                $spg = $this->db->insert('ms_data', $data);
                if ($spg) {
                    $response['status'] = true;
                    $response['message'] = "save success";
                    $response['cutomer_id'] = $this->db->insert_id();
                    // jumlah peluang 100 noted
                    /*
                     * get data hadiah dari database
                     */
                    if($event->stock_type=="global"){
                        $this->db->where("stock_date", '0000-00-00');
                        $this->db->where("total !=", "0");
                        $this->db->where("event_id", $this->input->post('event_id'));
                        $peluang = $this->db->get('stock_peluang_day');
                        if ($peluang->num_rows() > 0) {
                            $response['hadiah'] = $peluang->result();
                        } else {
                            $response['hadiah'] = array(
                                array(
                                    "nama" => "ZONK",
                                    "peluang" => 100
                                )
                            );
                        }
                    }else if($event->stock_type=='daily-per-spg'){
                        $this->db->where("stock_date", date("Y-m-d"));
                        $this->db->where("total !=", "0");
                        $this->db->where("spg_id",$this->input->post('spg_id'));
                        $this->db->where("event_id", $this->input->post('event_id'));
                        $peluang = $this->db->get('stock_peluang_day');
                        if ($peluang->num_rows() > 0) {
                            $response['hadiah'] = $peluang->result();
                        } else {
                            $response['hadiah'] = array(
                                array(
                                    "nama" => "ZONK",
                                    "peluang" => 100
                                )
                            );
                        }
                    }else if($event->stock_type=='global-per-spg'){
                        $this->db->where("stock_date", '0000-00-00');
                        $this->db->where("total !=", "0");
                        $this->db->where("spg_id",$this->input->post('spg_id'));
                        $this->db->where("event_id", $this->input->post('event_id'));
                        $peluang = $this->db->get('stock_peluang_day');
                        if ($peluang->num_rows() > 0) {
                            $response['hadiah'] = $peluang->result();
                        } else {
                            $response['hadiah'] = array(
                                array(
                                    "nama" => "ZONK",
                                    "peluang" => 100
                                )
                            );
                        }
                    }else {
                        $this->db->where("stock_date", date("Y-m-d"));
                        $this->db->where("total !=", "0");
                        $this->db->where("event_id", $this->input->post('event_id'));
                        $peluang = $this->db->get('stock_peluang_day');
                        if ($peluang->num_rows() > 0) {
                            $response['hadiah'] = $peluang->result();
                        } else {
                            $response['hadiah'] = array(
                                array(
                                    "nama" => "ZONK",
                                    "peluang" => 100
                                )
                            );
                        }
                    }
                } else {
                    $response['status'] = false;
                    $response['message'] = "Failed to Insert Data";
                }
            }
        }else{
            /*
            * return validation error and remove html tags error
            */
            $response['status']=false;
            $response['message']=strip_tags(validation_errors());
        }
        echo json_encode($response);
    }
    public function hadiah(){
        $this->db->where('event_id',$this->input->post('event_id'));
        $event=$this->db->get("ms_events")->row();
        $hadiah=$this->input->post("hadiah");

        if(!isset($hadiah) || $hadiah==""){
            $hadiah="ZONK";
        }
        /*
         * UNTUK PATOKAN HADIAH GRAND PRIZE
         */
        switch ($event->event_id){
            /*
             * serambi
             */
            case 2 :
                /*
                 * unset galaxy S8 if not right condition
                 */
                if($hadiah=="Samsung S8"){
                    /*
                     * it will be replace by other prize
                     */
                    $hadiah="ZONK";
                }
                $tgl_sekarang=strtotime(date('Y-m-d'));
                $tgl_grandprize=strtotime("2017-06-23");
                /*
                 * spg that use for grand prize
                 */
                $spg_id=$this->input->post('spg_id');
                if($tgl_sekarang==$tgl_grandprize){
                        /*
                         * CIPALI 102 KM
                         */
                        if($spg_id==30){
                            $this->db->where('peserta_id',$this->input->post("peserta_id"));
                            $peserta=$this->db->get("ms_data");
                            if($peserta->num_rows()>0){
                                $peserta_data=$peserta->row();
                                $adtional=json_decode($peserta_data->others);
                                if(isset($adtional->tenant) && $adtional->tenant=="pertamax turbo"){
                                    $hadiah="Samsung S8";
                                }
                            }
                        }
                }
                break;
        }
        //========CEK STOCK BILA ADA PAKE HADIAH ASLI KALO GAK ADA PAKE PENGGANTI===============
        if($event->stock_type=="global") {
            $this->db->where("stock_date", '0000-00-00');
        }else if(($event->stock_type=="daily")){
            $this->db->where("stock_date", date("Y-m-d"));
        }else if($event->stock_type=='daily-per-spg'){
            $this->db->where("stock_date", date("Y-m-d"));
            $this->db->where("spg_id",$this->input->post('spg_id'));
        }else{
            $this->db->where("stock_date",'0000-00-00');
            $this->db->where("spg_id",$this->input->post('spg_id'));
        }
        $this->db->where("event_id", $this->input->post('event_id'));
        $this->db->where("hadiah",$hadiah);
        $stock=$this->db->get('stock_peluang_day');
        if($stock->num_rows()>0){
            $sisaStock=$stock->row()->total;
            if($sisaStock>0){
                /*
                 * decrase stock hadiah
                 */
                $dataStock=array(
                    'total'=>($stock->row()->total)-1
                );
                $hadiah = $stock->row()->hadiah;
                if($event->stock_type=="global") {
                    $this->db->where("stock_date", '0000-00-00');
                }else if(($event->stock_type=="daily")){
                    $this->db->where("stock_date", date("Y-m-d"));
                }else if($event->stock_type=='daily-per-spg'){
                    $this->db->where("stock_date", date("Y-m-d"));
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }else{
                    $this->db->where("stock_date",'0000-00-00');
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }
                $this->db->where("event_id", $this->input->post('event_id'));
                $this->db->where("hadiah",$hadiah);
                $this->db->update('ms_stocks',$dataStock);

            }else{
                //hadiah pengganti jika stock hadiah saat ini == 0
                /*
                 * kurangi stock hadiah pengganti
                 */
                if($event->stock_type=="global") {
                    $this->db->where("stock_date", '0000-00-00');
                }else if(($event->stock_type=="daily")){
                    $this->db->where("stock_date", date("Y-m-d"));
                }else if($event->stock_type=='daily-per-spg'){
                    $this->db->where("stock_date", date("Y-m-d"));
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }else{
                    $this->db->where("stock_date",'0000-00-00');
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }
                $this->db->where("event_id", $this->input->post('event_id'));
                $this->db->where("total !=","0");
                /*
                 * UNTUK PATOKAN HADIAH GRAND PRIZE
                 */
                switch ($event->event_id) {
                    /*
                     * serambi
                     */
                    case 2 :
                        $this->db->where("hadiah !=","Samsung S8");
                        break;
                }
                $hadiahPengganti=$this->db->get('stock_peluang_day');
                if($hadiahPengganti->num_rows()>0) {
                    $dataStock=array(
                        'total'=>($hadiahPengganti->row()->total)-1
                    );
                    $hadiah = $hadiahPengganti->row()->hadiah;
                    if($event->stock_type=="global") {
                        $this->db->where("stock_date", '0000-00-00');
                    }else if(($event->stock_type=="daily")){
                        $this->db->where("stock_date", date("Y-m-d"));
                    }else if($event->stock_type=='daily-per-spg'){
                        $this->db->where("stock_date", date("Y-m-d"));
                        $this->db->where("spg_id",$this->input->post('spg_id'));
                    }else{
                        $this->db->where("stock_date",'0000-00-00');
                        $this->db->where("spg_id",$this->input->post('spg_id'));
                    }
                    $this->db->where("event_id", $this->input->post('event_id'));
                    $this->db->where("hadiah",$hadiah);
                    $this->db->update('ms_stocks',$dataStock);
                }else{
                    $hadiah="ZONK";
                }
            }
        }else{
            /*
             * kurangi stock hadiah pengganti
             */
            if($event->stock_type=="global") {
                $this->db->where("stock_date", '0000-00-00');
            }else if(($event->stock_type=="daily")){
                $this->db->where("stock_date", date("Y-m-d"));
            }else if($event->stock_type=='daily-per-spg'){
                $this->db->where("stock_date", date("Y-m-d"));
                $this->db->where("spg_id",$this->input->post('spg_id'));
            }else{
                $this->db->where("stock_date",'0000-00-00');
                $this->db->where("spg_id",$this->input->post('spg_id'));
            }
            $this->db->where("event_id", $this->input->post('event_id'));
            $this->db->where("total !=","0");
            /*
                * UNTUK PATOKAN HADIAH GRAND PRIZE
                */
            switch ($event->event_id) {
                /*
                 * serambi
                 */
                case 2 :
                    $this->db->where("hadiah !=","Samsung S8");
                    break;
            }
            $hadiahPengganti=$this->db->get('stock_peluang_day');
            if($hadiahPengganti->num_rows()>0) {
                $dataStock=array(
                    'total'=>($hadiahPengganti->row()->total)-1
                );
                $hadiah = $hadiahPengganti->row()->hadiah;
                if($event->stock_type=="global") {
                    $this->db->where("stock_date", '0000-00-00');
                }else if(($event->stock_type=="daily")){
                    $this->db->where("stock_date", date("Y-m-d"));
                }else if($event->stock_type=='daily-per-spg'){
                    $this->db->where("stock_date", date("Y-m-d"));
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }else{
                    $this->db->where("stock_date",'0000-00-00');
                    $this->db->where("spg_id",$this->input->post('spg_id'));
                }
                $this->db->where("event_id", $this->input->post('event_id'));
                $this->db->where("hadiah",$hadiah);
                $this->db->update('ms_stocks',$dataStock);
            }else{
                $hadiah="ZONK";
            }
        }


        /*
         * update data peserta yang sudah ikut raffle
         */
        $data=array(
            'hadiah'=>$hadiah,
            'raffle'=>"Y"
        );
        $this->db->where('peserta_id',$this->input->post("peserta_id"));
        $update=$this->db->update("ms_data",$data);
        if($update){
            $response['status']=true;
            $response['message']="data saved";
            $response['hadiah']=$hadiah;
        }else{
            $response['status']=false;
            $response['message']="Can not save data";
        }
        echo json_encode($response);
    }
}
