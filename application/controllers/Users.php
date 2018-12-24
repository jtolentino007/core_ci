<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Users extends CORE_Controller
    {
        public function __construct()
        {
            parent::__construct();
		    $this->load->model('Auth_model');
        }        
        
        public function new_user()
        {
            $data['title'] = "New User";
            $data['page_js']  = base_url(). "assets/js/app/user_new.js";
            $data['body'] = $this->load->view('pages/user_new', NULL, TRUE);
            $this->renderView($data);
        }

        public function list_user()
        {
            $data['title'] = "List of Users";
            $data['body'] = $this->load->view('pages/user_list', NULL, TRUE);
            $this->renderView($data);
        }

        public function profile()
        {
            $data['title'] = "My Profile";
            $data['body'] = $this->load->view('pages/my_profile', NULL, TRUE);
            $this->renderView($data);
        }
    }
    
?>