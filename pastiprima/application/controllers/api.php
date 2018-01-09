<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }
    public function login(){
        $this->load->library('form_validation'); // meload library untuk validasi field
        //=========RULES VALIDATION=====
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        /*
         * jika data valid masukan data
         */
        if ($this->form_validation->run() != FALSE) {
            //stor data spg
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            /*
             * get data spg by username and password
             */
            $this->db->where("username",$username);
            $this->db->where("password",$password);
            $spg=$this->db->get('ms_spg');
            //if result > 0
            if($spg->num_rows()>0){
                $response['status']=true;
                $response['message']="Login success";
                $response['data']=$spg->row();
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
        $this->form_validation->set_rules('product', 'Product', 'trim|required');
        $this->form_validation->set_rules('nominal', 'Nominal', 'trim|required|is_natural');
        /*
         * if all data send is valid continue
         */
        if ($this->form_validation->run() != FALSE) {
            /*
             * check if peserta is already participated
             */
            $this->db->where("noHP",$this->input->post('phone'));
            $check=$this->db->get("ms_peserta");
            if($check->num_rows()>0){
                /*
                 * return notice
                 */
                $response['status'] = false;
                $response['message'] = "You have participated this event.";
            }else {
                $nominal = $this->input->post('nominal');
                /*
                 * if nominal min 200.000 can participate event
                 */
                if ($nominal >= 200000) {
                    /*
                     * save data peserta to database
                     */
                    $data = array(
                        'nama' => $this->input->post('fullname'),
                        'email' => $this->input->post('email'),
                        'noHP' => $this->input->post('phone'),
                        'produk' => $this->input->post('product'),
                        'nominal' => $nominal,
                        'created_by' => $this->input->post('spg_id'),
                        'created_date'=>date('Y-m-d H:i:s')
                    );
                    $spg = $this->db->insert('ms_peserta', $data);
                    if ($spg) {
                        $response['status'] = true;
                        $response['message'] = "save success";
                        $response['cutomer_id'] = $this->db->insert_id();
                        // jumlah peluang 100 noted
                        /*
                         * get data hadiah dari database
                         */
                        $this->db->where("date_stock",date("Y-m-d"));
                        $this->db->where("total !=","0");
                        $peluang=$this->db->get('peluang');
                        if($peluang->num_rows()>0) {
                            $response['hadiah'] = $peluang->result();
                        }else{
                            $response['hadiah'] = array(
                                array(
                                    "nama"=>"ZONK",
                                    "peluang"=>100
                                )
                            );
                        }
                    } else {
                        $response['status'] = false;
                        $response['message'] = "Failed to Insert Data";
                    }
                }else{
                    /*
                     * return notice that have to buy more 200.0000
                     */
                    $response['status'] = false;
                    $response['message'] = "Nominal minimum IDR 200.000";
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
        $hadiah=$this->input->post("hadiah");
        if(!isset($hadiah) || $hadiah==""){
            $hadiah="ZONK";
        }

        //========CEK STOCK BILA ADA PAKE HADIAH ASLI KALO GAK ADA PAKE PENGGANTI===============
        $this->db->where("date_stock",date("Y-m-d"));
        $this->db->where("nama",$hadiah);
        $stock=$this->db->get('peluang');
        if($stock->num_rows()>0){
            $sisaStock=$stock->row()->total;
            if($sisaStock>0){
                /*
                 * decrase stock hadiah
                 */
                $dataStock=array(
                    'total'=>($stock->row()->total)-1
                );
                $hadiah = $stock->row()->nama;
                $this->db->where("date",date("Y-m-d"));
                $this->db->where("hadiah",$hadiah);
                $this->db->update('ms_stocks',$dataStock);
            }else{
                //hadiah pengganti jika stock hadiah saat ini == 0
                /*
                 * kurangi stock hadiah pengganti
                 */
                $this->db->where("date_stock",date("Y-m-d"));
                $this->db->where("total !=","0");
                $hadiahPengganti=$this->db->get('peluang');
                if($hadiahPengganti->num_rows()>0) {
                    $dataStock=array(
                        'total'=>($hadiahPengganti->row()->total)-1
                    );
                    $hadiah = $hadiahPengganti->row()->nama;
                    $this->db->where("date",date("Y-m-d"));
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
            $this->db->where("date_stock",date("Y-m-d"));
            $this->db->where("total !=","0");
            $hadiahPengganti=$this->db->get('peluang');
            if($hadiahPengganti->num_rows()>0) {
                $dataStock=array(
                    'total'=>($hadiahPengganti->row()->total)-1
                );
                $hadiah = $hadiahPengganti->row()->nama;
                $this->db->where("date",date("Y-m-d"));
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
            'ruffle'=>"Y"
        );
        $this->db->where('peserta_id',$this->input->post("peserta_id"));
        $update=$this->db->update("ms_peserta",$data);
        if($update){
            $response['status']=true;
            $response['hadiah']=$hadiah;
        }else{
            $response['status']=false;
            $response['message']="Can not save data";
        }
        echo json_encode($response);
    }
}
