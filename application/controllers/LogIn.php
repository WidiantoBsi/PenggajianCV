<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogIn extends CI_Controller {
	function __construct(){
		parent::__construct();

	}

	function index(){
		$this->load->view('Login');
	}

	function LogOut(){
		$this->session->sess_destroy('username');
		$this->session->sess_destroy('iduser');
	    redirect(base_url().'LogIn');
	}

	function Cek_Login(){
		$ID = $this->input->post('ID_Karyawan');
		$Password =  password_verify($this->input->post('Password'));
		$where = array('Password' => $Password, 'ID_Karyawan' => $ID);
		$db = $this->M_DBCV->edit_data($where,'user')->result();
		$data = $this->M_DBCV->edit_data($where,'user');
		$cek = $data->num_rows();

		if ($cek > 0) {
			foreach ($db as $row) {
				$Status = $row->Status;
			}
			$where2 = array('ID_Karyawan' => $ID);
			$DB = $this->M_DBCV->edit_data($where2,'karyawan')->result();
			foreach ($DB as $b) {
				$Nama = $b->Nama_Karyawan;
				$ID = $b->ID_Karyawan;
			}
				if ($Status == '0' ) {
				$session = array('id' => $ID,'username' => $Nama,'status' =>'AdminSuper');
				$this->session->set_userdata($session);
					redirect(base_url('PageHome'));
				}elseif ($Status=='1') {
				$session = array('id' => $ID,'username' => $Nama,'status' =>'Admin');
				$this->session->set_userdata($session);
					redirect(base_url('PageAdmin'));
				}
		}else{
			$this->session->set_flashdata('alert','Login Gagal! Username atau Password Salah');
			redirect(base_url('LogIn'));
		}
	}

}