<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Model{
   var $table = ''; //nama tabel dari database
   var $column_order = array(); //field yang ada di table user
   var $column_search = array(); //field yang diizin untuk pencarian
   var $order = array(); // default order
   var $join = array();
   var $where = array();
   var $group_select = array();
   var $select = '';
   var $group = '';

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function setup($data){
    $this->table = $data['table'];
    $this->column_order = $data['column_order'];
    $this->column_search = $data['column_search'];
    $this->order = $data['order'];
    if (array_key_exists('join', $data)) {
      $this->join = $data['join'];
    }
    if (array_key_exists('where', $data)) {
      $this->where = $data['where'];
    }
    if (array_key_exists('group_select', $data)) {
      $this->group_select = $data['group_select'];
    }
    if (array_key_exists('group', $data)) {
      $this->group = $data['group'];
    }
    if (array_key_exists('select', $data)) {
      $this->select = $data['select'];
    }

  }

  private function _get_datatables_query(){
       if ($this->select!='') {
         $this->db->select($this->select);
       }

       $this->db->from($this->table);
       if (!empty($this->join)) {
         foreach ($this->join as $jo => $j) {
           $this->db->join($jo,$j['kolom'],$j['jenis']);
         }
       }

       if (!empty($this->where)) {
         foreach ($this->where as $wh => $w) {
           $this->db->where($wh,$w);
         }
       }
       // die(var_dump($this->group_select));

       if (!empty($this->group_select)) {
         $this->db->group_start();
         foreach ($this->group_select as $gs => $g) {
           // die(var_dump($g));
           if ($g['tipe']=="like") {
             $this->db->like($g['kolom'],$g['nilai'],$g['jenis']);
           }
           if ($g['tipe']=="or_like") {
             $this->db->or_like($g['kolom'],$g['nilai'],$g['jenis']);
           }
         }
         $this->db->group_end();
       }

       // if (!empty($this->like)) {
       //   foreach ($this->like as $lk => $l) {
       //     $this->db->like($wh,$w);
       //   }
       // }

       if ($this->group!='') {
         $this->db->group_by($this->group);
       }

       $i = 0;
       foreach ($this->column_search as $item) // looping awal
       {
           if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
           {

               if($i===0) // looping awal
               {
                   $this->db->group_start();
                   $this->db->like($item, $_POST['search']['value']);
               }
               else
               {
                   $this->db->or_like($item, $_POST['search']['value']);
               }

               if(count($this->column_search) - 1 == $i)
                   $this->db->group_end();
           }
           $i++;
       }

       if(isset($_POST['order']))
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }
   }

   function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
