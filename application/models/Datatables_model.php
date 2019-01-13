<?php
    class Datatables_model extends CI_Model
    {
        public $table;
        public $select;
        public $column_order; //set column field database for datatable orderable
        public $column_search; //set column field database for datatable searchable 
        public $order; // default order 

        function __construct()
        {
            parent::__construct();
        }

        private function _get_query()
        {
            $this->db->select($this->select);
            $this->db->get($this->table);
            $i = 0;
            foreach ($this->column_search as $col) // loop column 
            {
                if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
                $_POST['search']['value'] = $_POST['search']['value'];
            } else
                $_POST['search']['value'] = '';
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start();
                    $this->db->like(($col), $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like(($col), $_POST['search']['value']);
                }
    
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
                $i++;
            }
            
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    }

?>