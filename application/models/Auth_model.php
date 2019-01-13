<?php
    class Auth_model extends CI_Model 
    {
        public $email;
        public $password;
        public $first_name;
        public $last_name;
        public $createdDateTime;
        public $modifiedDateTime;
        public $createdBy;
        public $modifiedBy;

        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
        }
    
        function get_users()
        {
            $this->db->select('id, CONCAT(first_name, " ", last_name) AS fullname, email, createdDateTime, modifiedDateTime, role');
            $query = $this->db->get('users');
            return $query->result();
        }

        public function AuthenticateUser()
        {
            $query = $this->db->get_where('users', array('email' => $this->email));
            $user = $query->result_array();

            if (count($user) > 0) {
                $hashed_password = $user[0]['password'];

                if (password_verify($this->password, $hashed_password) == 1 )
                {
                    unset($user[0]['password']);
                    $this->session->set_userdata('currenty_logged',$user[0]);
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
            $currently_logged = $this->session->userdata('currenty_logged');

            $this->email        = $this->input->post('email');
            $this->password     = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
            $this->first_name   = $this->input->post('first_name');
            $this->last_name    = $this->input->post('last_name');
            $this->createdDateTime = date("Y-m-d H:i:s");
            $this->modifiedDateTime = date("Y-m-d H:i:s");
            $this->createdBy = $currently_logged['id'];

            $this->db->insert('users',$this);

            if ($this->db->affected_rows() > 0) 
                return true;
            else 
                return false;

        }

        public function updateUser()
        {
            $id                 = $this->input->post('id');
            $email              = $this->input->post('email');
            $first_name         = $this->input->post('first_name');
            $last_name          = $this->input->post('last_name');
            $modifiedDateTime   = date("Y-m-d H:i:s");
            $modifiedBy         = $this->session->userdata('currently_logged')['id'];
            $password           = $this->input->post('password');
            $hashedPassword     = password_hash($password,PASSWORD_BCRYPT);

            $user = array(
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'modifiedDateTime' => $modifiedDateTime,
                'modifiedBy' => $modifiedBy
            );

            if (empty($password)) {
                $this->db->set('password', 'password', FALSE);
            } else {
                $user['password'] = $hashedPassword;
            }

            $this->db->set($user);
            $this->db->where('id', $id);
            $this->db->update('users');

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