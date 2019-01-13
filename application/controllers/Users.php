<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Users extends CORE_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Auth_model');
            $this->load->library('session');
            $this->validateSession();
        }        
        
        // Views
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
            $data['page_js']  = base_url(). "assets/js/app/user_list.js";
            $data['body'] = $this->load->view('pages/user_list', NULL, TRUE);
            $this->renderView($data);
        }

        public function profile()
        {
            $data['title'] = "My Profile";
            $data['page_js']  = base_url(). "assets/js/app/my_profile.js";
            $data['body'] = $this->load->view('pages/my_profile', NULL, TRUE);
            $this->renderView($data);
        }

        // RESTs
        public function get_users_list()
        {
            header('Content-Type: application/json');
            $m_user = $this->Auth_model;
            $response['data'] = $m_user->get_users();
            echo json_encode($response, JSON_PRETTY_PRINT);
        }

        public function get_current_user()
        {
            header('Content-Type: application/json');
            $currentUser = $this->session->userdata('currenty_logged');
            echo json_encode($currentUser, JSON_PRETTY_PRINT);
        }
    }
    
?>