<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_tl extends CI_Controller {
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
        $crud->set_subject('TL');
        $crud->set_table('ms_admin')->columns('username','created','status');
        $crud->where('ms_admin.status !=', 'admin');
        /*
         * end set display
         */
        //========SET KOLOM UNTUK CRUD=========
        $crud->add_fields('username', 'password');
        $crud->edit_fields('username', 'password');
        $crud->required_fields('username', 'password');
        $crud->field_type('password', 'password');
        $crud->field_type('verify_password', 'password');
        $crud->change_field_type('verify_password', 'password');
        //========END SET KOLOM UNTUK CRUD========
        /*
         * begin callback for grocery crud
         */
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
        $data['title'] = "Manage TL";
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
        return $this->db->update('ms_admin',$post_array,array('admin_id' => $primary_key));
    }
    /*
     * callback for insert user
     */
    function insert_user($post_array) {
        unset($post_array['verify_password']);
        $post_array['password']=md5($post_array['password']);
        $post_array['status']='tl';
        $post_array['created']=date('Y-m-d H:i:s');
        return $this->db->insert('ms_admin',$post_array);
    }

}
