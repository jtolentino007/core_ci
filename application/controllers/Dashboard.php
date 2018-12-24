<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CORE_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->validateSession();
        }

        public function index()
        {
            $data['title']    = "Dashboard";
            $data['page_js']  = base_url(). "assets/vendor/admin/js/pages/dashboard.js";
            $data['body']     = $this->load->view('pages/dashboard', NULL, TRUE);
            $this->renderView($data);
        }
    }

?>