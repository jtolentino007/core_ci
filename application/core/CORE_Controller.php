<?php
    class CORE_Controller extends CI_Controller 
    {
        function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $this->load->helper('url');
        }

        public function validateSession()
        {
            if (!$this->session->userdata('currenty_logged'))
            {
                redirect(base_url().'auth');
            }
        }

        public function renderView($data)
        {
            $this->load->view('partials/header',$data);
            $this->load->view('partials/menu',$data);
            $this->load->view('partials/footer');
        }
    }
?>