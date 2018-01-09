<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
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

    public function index()
    {
        /*
         * load grocery CRUD
         */
        $crud = new grocery_CRUD();
        /*
        * set display kolom untuk grocery crud
        */
        $crud->set_subject('Event');
        $crud->set_table('ms_events')->columns('event_name','event_logo','event_start','event_end');
        /*
         * end set display
         */
        //========SET KOLOM UNTUK CRUD=========
        $crud->add_fields('event_name','event_logo','event_start','event_end','stock_type','raffle');
        $crud->edit_fields('event_name','event_logo','event_start','event_end','stock_type','raffle');
        $crud->required_fields('event_name','event_start','event_end','stock_type','raffle');
        $crud->set_field_upload('event_logo','assets/uploads/files');
        $crud->callback_after_insert(array($this, 'callback_after_insert_event'));
        $crud->unset_delete();
        $output = $crud->render();
        /*
        * store data for all variable
        */
        $data['title'] = "Manage Events";
        $data['output'] = $output->output;
        $data['css_files'] = $output->css_files;
        $data['js_files'] = $output->js_files;
        $data['username']=$this->session->userdata('user_username');
        $data['status']=$this->session->userdata('user_status');
        /*
       * begin set template for web app
       */
        $template['content']=$this->load->view('gcrud',$data,true);
        $template['username']=$data['username'];
        $this->load->view('main',$template);
    }
    /*
     * after insert event create default field
     */
    public function callback_after_insert_event($post_array,$primary_key){
        $data=array(
            'field_name'=>"fullname",
            'field_placeholder'=>"fullname",
            'field_type'=>"text",
            'event_id'=>$primary_key
        );
        $this->db->insert('ms_fields',$data);
        $data=array(
            'field_name'=>"email",
            'field_placeholder'=>"email",
            'field_type'=>"email",
            'event_id'=>$primary_key
        );
        $this->db->insert('ms_fields',$data);
        $data=array(
            'field_name'=>"phone",
            'field_placeholder'=>"phone",
            'field_type'=>"phone",
            'event_id'=>$primary_key
        );
        $this->db->insert('ms_fields',$data);
        $data=array(
            'field_name'=>"product",
            'field_placeholder'=>"product",
            'field_type'=>"select",
            'event_id'=>$primary_key
        );
        $this->db->insert('ms_fields',$data);
        return true;
    }
    public function form(){
        $data['username']=$this->session->userdata('user_username');
        $data['status']=$this->session->userdata('user_status');
        $data['events']=$this->ms_events->getAllEvents();
        $template['content']=$this->load->view('form',$data,true);
        $template['username']=$data['username'];
        $this->load->view('main',$template);
    }
    public function getField($event_id=null){
        $fields=$this->ms_events->getEventFields($event_id);
        $response['data']=$fields;
        $response['status']=true;
        echo json_encode($response);
    }
    public function savefield(){
        /*
        * load lib validation
        */
        $this->load->library('form_validation');
        /*
         * set rules for validation
         */
        $this->form_validation->set_rules('name[]', 'Name', 'trim|required');
        $this->form_validation->set_rules('placeholder[]', 'Placeholder', 'trim|required');
        $this->form_validation->set_rules('type[]', 'Type', 'trim|required');
        /*
         * if true than continue process save
         */
        if ($this->form_validation->run() != FALSE) {
            $name=$this->input->post('name');
            $placeholder=$this->input->post('placeholder');
            $type=$this->input->post('type');
            $order=$this->input->post('order');
            $values=$this->input->post('values');
            $this->db->where('event_id',$this->input->post('event_id'));
            $this->db->delete('ms_fields');
            for ($i=0;$i<count($name);$i++){
                $data=array(
                  'field_name'=>$name[$i],
                  'field_placeholder'=>$placeholder[$i],
                  'field_type'=>$type[$i],
                  'field_values'=>$values[$i],
                  'field_order'=>$order[$i],
                  'event_id'=>$this->input->post('event_id')
                );
                $this->ms_events->saveFieldFO($data);
            }
            $response['status']=true;
            $response['message']="field saved";
        }else{
            $response['status']=false;
            $response['message']=validation_errors();
        }
        echo json_encode($response);
    }
}
