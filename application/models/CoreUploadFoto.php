<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoreUploadFoto extends CI_Model{
  private $nama_foto,$nama_video;
  public function __construct()
  {
    parent::__construct();
    $this->load->library('upload');
    //Codeigniter : Write Less Do More
  }

  public function get_nama_foto(){
    return $this->nama_foto;
  }

  public function upload_foto($path){
    $config['upload_path'] = $path; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|JPG|PNG|JPEG|BMP|GIF'; //type yang dapat diakses
    $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
    $this->upload->initialize($config);
    if(!empty($_FILES['filefoto']['name'])){
        if ($this->upload->do_upload('filefoto')){
            $gbr = $this->upload->data();
            $this->nama_foto = $gbr['file_name'];
            return true;
        }
    }
    return false;
  }

  public function get_nama_video(){
    return $this->nama_video;
  }


  public function upload_video($path){
  $config['upload_path'] = $path; //path folder
  $config['allowed_types'] = 'mp4|mkv|flv|MKV|MP4|FLV'; //type yang dapat diakses
  $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
  $this->upload->initialize($config);
  if(!empty($_FILES['file']['name'])){
      if ($this->upload->do_upload('file')){
          $video = $this->upload->data();
          $this->nama_video = $video['file_name'];
          return true;
      }
  }
  return false;
}
}
