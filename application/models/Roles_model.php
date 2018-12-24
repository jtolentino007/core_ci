<?php
    class Roles_model extends CI_Model
    {
            public $id;
            public $role;

        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function getRolesList()
        {
            $query = $this->db->get('roles');
            return $query->result();
        }

        public function insertRole()
        {
            $this->role = $this->input->post('role');

            $this->db->insert('roles',$this);

            if ($this->db->affected_rows() > 0) 
                return true;
            else 
                return false;
        }

        public function updateRole()
        {
            $id = $this->input->post('id');
            $this->role = $this->input->post('role');

            $this->db->where('id', $id);
            $this->db->update('roles',$this);

            if ($this->db->affected_rows() > 0) 
                return true;
            else 
                return false;
        }

        public function deleteRole()
        {
            $id = $this->input->post('id');
            $this->db->where('id', $id);
            $this->db->delete('roles');

            if ($this->db->affected_rows() > 0)
                return true;
            else 
                return false;
        }
    }
?>