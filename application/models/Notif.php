<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notif extends CI_Model
{


  /**

   * @author Fendrik Nurul Jadid <fendrik1311@gmail.com>

   * @since v.1.0

   **/


  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function berhasil($param)
  {
    return '<div class="alert alert-success myalert animated fadeInRight">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         <h3 class="text-success"><i class="fa fa-check"></i> Success</h3> ' . $param . '
     </div>';
  }

  public function gagal($param)
  {
    return '<div class="alert alert-danger myalert animated fadeInRight">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         <h3 class="text-danger"><i class="fa fa-close"></i> Error</h3> ' . $param . '
     </div>';
  }

  public function info($param)
  {
  }
  public function warning($param)
  {
    return '<div class="alert alert-warning myalert animated fadeInRight">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
         <h3 class="text-warning"><i class="fa fa-close"></i> Peringatan !!</h3> ' . $param . '
     </div>';
  }
}
