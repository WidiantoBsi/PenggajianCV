<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AbsensiQR extends CI_Controller {
function __construct(){
	parent::__construct();
}

function index(){
	//Halaman Absensi Masuk
	$this->session->sess_destroy();
	$this->load->view('Admin/AbsensiIn');
}


function AbsensiOut(){
	//Halaman Absensi Keluar
	$this->session->sess_destroy();
	$this->load->view('Admin/AbsensiOut');
}

function ScaneQR(){ //Absensi Masuk
	$ID = $this->input->post('IdKaryawan'); // ambil data idKaryawan
	$JamIn = date('H:i:s'); // ambil data jam sekarang
	$tanggal = date('Ymd'); //ambil data tahun tanggal bulan sekarang

	$IdAbsen = $ID.$tanggal; 

	$where = array('ID_Karyawan' => $ID); // ambil data dari database karyawan
	$CekAbsen = array('Id_Absen' => $IdAbsen); //id absen id karyawan dan tanggal sekarang

	$data = $this->M_DBCV->edit_data($where, 'karyawan'); //Input Data Karyawan
	$Cek = $data->num_rows();
	if ($Cek >0) { //cek data karyawan di database
		//jika ada data karyawan
		$Db = $this->M_DBCV->edit_data($CekAbsen,'absensi'); // Input Data Absensi
		$DbCek = $Db->num_rows(); //cek id absensi
		if ($DbCek >0) {  // cek data absensi
		$this->session->set_flashdata('alert','Absensi sudah dilakukan!');
		redirect(base_url().'AbsensiQR');
		}elseif ($DbCek <1) { // jika data kosong atau belom ada
			$Ket = 0;
			$InData = array(
				'Id_Absen' => $IdAbsen,
				'ID_Karyawan' => $ID,
				'Jam_In' => $JamIn,
				'Bulan' => $tanggal,
				'Keterangan' => $Ket
			);
			$this->M_DBCV->insert_data($InData,'absensi');
			$this->session->set_flashdata('Pesan','Absensi Berhasil Terinput');
			redirect(base_url().'AbsensiQR');
		}else { // Jika tidak sesuai
			$this->session->set_flashdata('alert','Data Tidak Terdeteksi!');
			redirect(base_url().'AbsensiQR');
		}	
	}else{ //data karyawan tidak ada
		$this->session->set_flashdata('alert','Data Tidak Terdaftar!');
		redirect(base_url().'AbsensiQR');
	}
}

function ScaneQROut(){ //Absennnsi Keluar
	$ID = $this->input->post('IdKaryawan');
	$JamOut = date('H:i:s');
	$tanggal = date('Y-m-d');
	// $IdAbsen = $this->M_DBCV->KodeAbsen();

	$where = array('ID_Karyawan' => $ID);
	
	$CekDB = $this->M_DBCV->edit_data($where,'absensi'); //Input Data absensi
	$IdCek = $CekDB->num_rows();  
	if ($IdCek > 0) {   // cek data absensi
		$Db = $this->M_DBCV->edit_data($where,'absensi')->result();
		foreach ($Db as $row){
			$CekAbsen = $row->Keterangan;
		}
		if ($CekAbsen == 0) {
		$Ket = 1;
			$data = array(
			'Jam_Out' => $JamOut,
			'Bulan' => $tanggal,
			'Keterangan' => $Ket
			);
		$this->M_DBCV->update_data('absensi',$data,$where);
		$this->session->set_flashdata('Pesan','Absensi Berhasil Terinput');
		redirect('AbsensiOut');
		}else{
			$this->session->set_flashdata('alert','Absensi sudah dilakukan!');
			redirect('AbsensiOut');
		}
	}else{
		$this->session->set_flashdata('alert','Anda belum melakukan Absensi!');
		redirect('AbsensiOut');
	}
}

}