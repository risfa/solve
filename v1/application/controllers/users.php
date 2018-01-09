<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
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
        $crud->set_subject('user');
        $crud->set_table('ms_users')->columns('fullname','username','created_date','created_by');
        $crud->set_relation('created_by', 'ms_users', 'fullname');
        $status=$this->session->userdata('user_status');
        $user_id=$this->session->userdata('user_user_id');
        if($status=='admin' || $status=='tl'){
            $crud->where('ms_users.created_by', $user_id);
        }
        /*
         * end set display
         */
        //========SET KOLOM UNTUK CRUD=========
        $crud->add_fields('fullname','username', 'password','verify_password');
        $crud->edit_fields('fullname','username', 'password');
        $crud->required_fields('fullname','username', 'password','verify_password');
        $crud->field_type('password', 'password');
        $crud->field_type('verify_password', 'password');
        $crud->change_field_type('verify_password', 'password');
        //========END SET KOLOM UNTUK CRUD========
        /*
         * begin callback for grocery crud
         */
        $crud->callback_after_delete(function($primary_key){
            $status=$this->session->userdata('user_status');
            $event_id=$this->session->userdata('user_event_id');
            if($status=='admin'){
                $this->db->where('user_id',$primary_key);
                $this->db->where('event_id',$event_id);
                $this->db->where('role_id','3');
                $this->db->delete('user_to_event');
            }
            if($status=='tl'){
                $this->db->where('user_id',$primary_key);
                $this->db->where('event_id',$event_id);
                $this->db->where('role_id','4');
                $this->db->delete('user_to_event');
            }
            if($status=='superuser'){
                $this->db->where('user_id',$primary_key);
                $this->db->where('event_id',$event_id);
                $this->db->where('role_id','1');
                $this->db->delete('user_to_event');
            }
            return true;
        });
        $crud->callback_before_insert(array($this, 'unset_verification'));
        $crud->callback_before_update(array($this, 'unset_verification'));
        $crud->callback_edit_field('password', array($this, 'set_password_input_to_empty'));
        $crud->callback_add_field('password', array($this, 'set_password_input_to_empty'));
        $crud->callback_update(array($this, 'update_user'));
        $crud->callback_insert(array($this, 'insert_user'));
        /*
       * end callback for grocery crud
       */
        $output = $crud->render();
        /*
        * store data for all variable
        */
        switch ($status){
            default :
                $data['title'] = "Manage Users";
                break;
            case 'admin'  :
                $data['title'] = "Manage TL";
                break;
            case 'tl' :
                $data['title'] = "Manage Officer";
                break;
        }
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
    * callback for unset field verfy
    */
    function unset_verification($post_array) {
        unset($post_array['verify_password']);
        return $post_array;
    }
    /*
     * callback for set password emptry
     */
    function set_password_input_to_empty() {
        return "<input type='password' name='password' value='' />";
    }
    /*
      * callback for update user
      */
    function update_user($post_array, $primary_key) {
        unset($post_array['verify_password']);
        $post_array['password']=md5($post_array['password']);
        return $this->db->update('ms_users',$post_array,array('user_id' => $primary_key));
    }
    /*
     * callback for insert user
     */
    function insert_user($post_array) {
        unset($post_array['verify_password']);
        $post_array['password']=md5($post_array['password']);
        $post_array['created_date']=date('Y-m-d H:i:s');
        $post_array['created_by']=$this->session->userdata('user_user_id');
        $this->db->insert('ms_users',$post_array);
        $inserted_id=$this->db->insert_id();
        $status=$this->session->userdata('user_status');
        $event_id=$this->session->userdata('user_event_id');
        if($status=='admin'){
            $data=array(
                'role_id'=>'3',
                'event_id'=>$event_id,
                'user_id'=>$inserted_id
            );
            return $this->db->insert('user_to_event',$data);
        }
        if($status=='tl'){
            $data=array(
                'role_id'=>'4',
                'event_id'=>$event_id,
                'user_id'=>$inserted_id
            );
            return $this->db->insert('user_to_event',$data);
        }
        if($status=='superuser'){
            $data=array(
                'role_id'=>'1',
                'event_id'=>$event_id,
                'user_id'=>$inserted_id
            );
            return $this->db->insert('user_to_event',$data);
        }
        return true;
    }
}
