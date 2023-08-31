<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPenyakit extends CI_Model{

   var $table = 'penyakit'; //nama tabel dari database
   var $column_order = array(null, 'kodeicdx','nama_penyakit','indonesia','wabah','nular','bpjs', 'non_spesialis', 'idpenyakit'); //field yang ada di table user
   var $column_search = array('kodeicdx','nama_penyakit','indonesia','wabah','nular','bpjs', 'non_spesialis'); //field yang diizin untuk pencarian
   var $order = array('idpenyakit' => 'asc'); // default order

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    // $this->db->join("icd_table","penyakit.kodeicdx=icd_table.kode","LEFT");
    return $this->db->get('penyakit')->result();
  }

  public function get_data_edit($idpenyakit)
  {
    return $this->db->get_where('penyakit', array('idpenyakit' => $idpenyakit))->row_array();
  }


  private function _get_datatables_query()
   {
       $this->db->from($this->table);

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
       // $this->db->join("icd_table","penyakit.kodeicdx=icd_table.kode");
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

   public function yatidak($value)
   {
     if ($value == 1) {
       return "Ya";
     }else {
       return "Tidak";
     }
   }

   public function edit($value)
   {
     $link = base_url().'Penyakit/edit/'.$value;
     $link2 = base_url().'Penyakit/delete/'.$value;
     // return "<a href= '".$link. "'>
     //   <button type=\"button\" class=\"btn btn-circle btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Edit\">
     //     <i class=\"fa fa-edit\"></i>
     //   </button>
     // </a>";
     return '<span class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ti-settings"></i>
                    </button>
                    <span class="dropdown-menu animated flipInY">
                      <a class="dropdown-item" href="'.$link.'">Edit Data</a>
                      <a class="dropdown-item hapus-true" href="#" id="'.$link2.'">Hapus Data</a>
                      </span>
                  </span>';
   }

   function no_penyakit($id_check,$no)
   {
     return "
     <div class=\"custom-control custom-checkbox\">
       <input type=\"checkbox\" class=\"custom-control-input id_checkbox \" id=\"customCheck$id_check\" name=\"id[]\" value=\"$id_check\">
       <label class=\"custom-control-label\" for=\"customCheck$id_check\">$no</label>
     </div>
     ";
   }

}
