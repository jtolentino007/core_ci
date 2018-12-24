<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Roles extends CI_Controller 
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Roles_model');
        }

        public function index()
        {
            $this->load->view('app/roles');
        }

        public function save()
        {
            $m_roles = $this->Roles_model;

            if ($m_roles->insertRole())
            {
                $response['status'] = "success";
                $response['message'] = "Successfully added role";
            }
            else 
            {
                $response['status'] = "error";
                $response['message'] = "Error occured while adding role";
            }

            echo json_encode($response);
        }

        public function update()
        {
            $m_roles = $this->Roles_model;

            if ($m_roles->updateUser()) {
                $response['status'] = "success";
                $response['message'] = "Successfully updated role";
            } else {
                $response['status'] = "error";
                $response['message'] = "Error occured while updating the role";
            }

            echo json_encode($response);	
        }

        public function delete()
        {
            $m_roles = $this->Roles_model;

            if ($m_roles->deleteUser())
            {
                $response['status'] = "success";
                $response['message'] = "Successfully deleted";
            } else {
                $response['status'] = "error";
                $response['message'] = "Error occured while deleting the role";
            }
        }
    }
?>