<?php
defined('BASEPATH') or exit ('No Direct Script Access Allowed');

class M_DBCV extends CI_Model{
  function edit_data($where,$table){
    return $this->db->get_where($table,$where);
  }

  function get_data($table){
    return $this->db->get($table);
  }

  function insert_data($data,$table){
    $this->db->insert($table,$data);
  }

  function update_data($table,$data,$where){
    $this->db->update($table,$data,$where);
  }

  function delete_data($where,$table){
    $this->db->where($where);
    $this->db->delete($table);
  }

  function kosongkan_data($table){
    return $this->db->truncate($table);
  }

  function get_User(){
    $hasil=$this->db->query("SELECT * FROM golongan");
    return $hasil;
  }

  function cek_internet(){
     $connected = @fsockopen("www.google.com", 80);
     if ($connected){
      $is_conn = true; //jika koneksi tersambung
      fclose($connected);
     }else{
      $is_conn = false; //jika koneksi gagal
     }
     return $is_conn;
  }

  function Tampil_Data($keyword = null){
    if ($keyword) {
      $this->db->like('Tgl_Transaksi', $keyword);
    }
    
    $query = $this->db->get('penggajian')->result();
    return $query;
  }

  function JumlahGaji($keyword = null){
    if ($keyword) {
      $this->db->like('Tgl_Transaksi', $keyword);
    }
    
    $query = $this->db->get('penggajian')->num_rows();
    return $query;
  }

  function format_rupiah($rp) {
  $hasil = "Rp." . number_format($rp, 0, "", ".") . ".00";
  return $hasil;
  }

  function get_subkategori($id){
    $hasil=$this->db->query("SELECT * FROM karyawan WHERE ID_Golongan='$id'");
    return $hasil->result();
  }

  function get_Bagian(){
    $hasil=$this->db->query("SELECT * FROM golongan");
    return $hasil;
  }

  function get_Karyawan(){
    $hasil=$this->db->query("SELECT * FROM karyawan");
    return $hasil;
  }

  function SetPassword($length){
    $str        = "";
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $max        = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
  }

  public function hitungJumlah($keyword = null){
    if ($keyword) {
      $this->db->like('Tgl_Transaksi', $keyword);
    }
    $this->db->select_sum('SubTotalupah');
    $query = $this->db->get('penggajian');
    if($query->num_rows()>0)
    {
      return $query->row()->SubTotalupah;
    }
    else
    {
      return 0;
    }
  }

  function Jumlah_Lembur($Id = null){
    if ($Id) {
      $this->db->like('ID_Karyawan', $Id);
    }
    $this->db->select_sum('Lembur');
    $query = $this->db->get('absensi');
    if($query->num_rows()>0)
    {
      return $query->row()->Lembur;
    }
    else
    {
      return 0;
    }
  }

  public function kode_Karyawan()   {
      $this->db->select('RIGHT(karyawan.ID_Karyawan,3) as kode', FALSE);
      $this->db->order_by('ID_Karyawan','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('karyawan');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
      $tgl = date('mY'); //Y-m-d
      $kodejadi = $tgl.$kodemax;    // hasilnya WDM-001 dst.
      return $kodejadi;  
  }

  public function buat_kode()   { //kode golongan
      $this->db->select('RIGHT(golongan.ID_Golongan,3) as kode', FALSE);
      $this->db->order_by('ID_Golongan','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('golongan');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 3 menunjukkan jumlah digit angka 0
      $kodejadi = "UP-".$kodemax;    // hasilnya UP-001 dst.
      return $kodejadi;  
  }


  public function kode_Rekap()   {
      $this->db->select('RIGHT(penggajian.ID_Gaji,3) as kode', FALSE);
      $this->db->order_by('ID_Gaji','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('penggajian');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
      $tgl = date('ym'); //Y-m-d
      $kodejadi = "GJI-".$tgl.$kodemax;    // hasilnya WDM-001 dst.
      return $kodejadi;  
  }

  function KodeUser(){
    $this->db->select('RIGHT(user.Id_User,3) as kode', FALSE);
      $this->db->order_by('Id_User','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('user');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->kode) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
      $kodejadi = "ADM-".$kodemax;    // hasilnya WDM-001 dst.
      return $kodejadi;  
  }

}