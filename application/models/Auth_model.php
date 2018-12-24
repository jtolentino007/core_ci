<?php
    class Auth_model extends CI_Model 
    {
        public $email;
        public $password;
        public $first_name;
        public $last_name;

        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
        }
        
        public function getUsersList() 
        {
            $query = $this->db->get('users');
            return $query->result();
        }

        public function getUserById()
        {
            $this->db->select('email, first_name, last_name');
            $query = $this->db->get_where('users', array('email' => $this->email));
        }

        public function AuthenticateUser()
        {
            $query = $this->db->get_where('users', array('email' => $this->email));
            $user = $query->result_array();

            if (count($user) > 0) {
                $hashed_password = $user[0]['password'];

                if (password_verify($this->password, $hashed_password) == 1 )
                {
                    $this->session->set_userdata('currenty_logged',json_encode($user[0]));
                    return true;
                }
                else return false;
            } else {
                return false;
            }
            
        }

        public function SignOut()
        {
            session_destroy();
            redirect(base_url().'auth');
        }

        public function InsertUser()
        {
            $this->email        = $this->input->post('email');
            $this->password     = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
            $this->first_name   = $this->input->post('first_name');
            $this->last_name    = $this->input->post('last_name');

            $this->db->insert('users',$this);

            if ($this->db->affected_rows() > 0) 
                return true;
            else 
                return false;
        }

        public function updateUser()
        {
            $id                 = $this->input->post('id');
            $this->email        = $this->input->post('email');
            $this->first_name   = $this->input->post('first_name');
            $this->last_name    = $this->input->post('last_name');
            $this->password     = $this->input->post('password');

            $this->db->where('id', $id);
            $this->db->update('users',$this);

            if ($this->db->affected_rows() > 0)
                return true;
            else 
                return false;
        }

        public function deleteUser()
        {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->delete('users');

            if ($this->db->affected_rows() > 0)
                return true;
            else 
                return false;
        }
    }
?>