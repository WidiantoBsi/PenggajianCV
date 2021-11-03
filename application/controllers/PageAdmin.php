<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageAdmin extends CI_Controller {
function __construct(){
	parent::__construct();
	$this->load->library('pdf');
	if($this->session->userdata('status')!= "Admin"){
      redirect(base_url().'LogOut');
    }
}

function index(){
	$db = date('Y-m');
	// $where = array('Tgl_Transaksi' => $id);
	$Penggajian = $this->M_DBCV->JumlahGaji($db);
	$Absensi = $this->M_DBCV->get_data('absensi')->num_rows();
	$Karyawan = $this->M_DBCV->get_data('karyawan')->num_rows();
	// $Penggajian = $this->M_DBCV->edit_data($where,'penggajian')->num_rows();
	$Data['DbGaji'] = $Penggajian/$Karyawan*100;
	$Data['DbKeluar'] = $Absensi/$Karyawan*100;
	$Data['Karyawan'] = $this->M_DBCV->get_data('karyawan')->num_rows();
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Admin/Header',$data);
	$this->load->view('Admin/Dashboard',$Data);
	$this->load->view('Admin/Footer');
}

function EditPengguna(){
	$ID = $this->input->post('ID');
	$Pass = $this->input->post('Password');

	$where = array('ID_Karyawan' => $ID);
	$data = array(
		'Password' => $Pass
	);
	$this->M_DBCV->update_data('user',$data,$where);
	redirect(base_url().'PageAdmin');
}

 // === Data Absensi ===
function DataAbsensi(){
	$db = date('Y-m-d');
	$where = array('Bulan' => $db);
	$data['Absensi'] = $this->M_DBCV->edit_data($where,'absensi')->result();
	// $data['IdAbsen'] = $this->M_DBCV->KodeAbsen();
	$data['Karyawan'] = $this->M_DBCV->get_Karyawan();
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Admin/Header',$data);
	$this->load->view('Admin/DataAbsensi',$data);
	$this->load->view('Admin/Footer');
}

function EditAbsensi(){
	$ID = $this->input->post('Id_karyawan');
	$Lembur = $this->input->post('lembur');

	$where = array('ID_Karyawan' => $ID);
	$data = array(
		'Lembur' => $Lembur
	);
	$this->M_DBCV->update_data('absensi',$data,$where);
	redirect(base_url().'Absensi');
}

 // === Data Penggajian ===
function Penggajian(){
	$data ['IdGaji'] = $this->M_DBCV->kode_Rekap();
	$data['Penggajian'] = $this->M_DBCV->get_data('karyawan')->result();
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Admin/Header',$data);
	$this->load->view('Admin/DataPenggajian',$data);
	$this->load->view('Admin/Footer');
}

function SlipGaji(){
	$data['keyword'] = date('Y-m');
	$data['Penggajian'] = $this->M_DBCV->Tampil_Data($data['keyword']);
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Admin/Header',$data);
	$this->load->view('Admin/SlipGaji',$data);
	$this->load->view('Admin/Footer');
}

function AddPenggajian(){
	$id = $this->input->post('IdKaryawan');
	$Harian = $this->input->post('UpahHarian'); //Upah Harian
	$TtlMasuk = $this->input->post('TotalMasuk'); //Jumlah Masuk
	$Lembur = $this->input->post('UpahLembur'); //Upah Lembur
	$TtlLembur = $this->input->post('TotalLembur'); //Jumlah Lembur
	$Bpjs = $this->input->post('Bpjs');
	$Snak = $this->input->post('Snak');
	$Insentive = $this->input->post('Insentive');
	$Potongan = $this->input->post('Potongan');
	$IDGaji = $this->input->post('IdGaji');
	$Tanggal = date('Y-m-d');
	$Total = $Harian*$TtlMasuk+$Lembur*$TtlLembur+$Bpjs+$Snak+$Insentive;
	$SubTotal = $Total-$Potongan;

	$data = array(
		'ID_Gaji' => $IDGaji,
		'ID_Karyawan' => $id,
		'Total_Masuk' => $TtlMasuk,
		'Total_Lembur' => $TtlLembur,
		'BPJS' => $Bpjs,
		'Snak' => $Snak,
		'Potongan' => $Potongan,
		'Insentive'=> $Insentive,
		'Tgl_Transaksi' => $Tanggal,
		'SubTotalupah' => $SubTotal
	);
	$this->M_DBCV->insert_data($data,'penggajian');
	redirect(base_url().'Penggajian');
}

function HapusPenggajian(){
	$id = $this->input->post('ID');
	$where = array('ID_Gaji' => $id);
	$this->M_DBCV->delete_data($where,'penggajian');
	redirect('SlipGaji');
}

function PrintPdf($id){
	$pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(290,7,'CV. HIKARI TECHNOLOGY',0,2,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(290,7,'SLIP GAJI',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(15,7,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(15,7,'',0,1);
		// Pemangilan DB karyawan
		$where = array('ID_Gaji' => $id);
		$db = $this->M_DBCV->edit_data($where,'penggajian')->result();
		foreach ($db as $row){
			$Dt_Gji = $row->ID_Gaji;
			$Dt_Kry = $row->ID_Karyawan;
			$Dt_Msk = $row->Total_Masuk;
			$Dt_Lmbr = $row->Total_Lembur;
			$Dt_Bpjs = $row->BPJS;
			$Dt_Snk = $row->Snak;
			$Dt_Ptng = $row->Potongan;
			$Dt_Instif = $row->Insentive;
			$Dt_SubTtl = $row->SubTotalupah;
			$Dt_Tgl = $row->Tgl_Transaksi;  
		}	
		// End DB Karyawan
		// DB Karayawan
        $where = array('ID_Karyawan' => $Dt_Kry);
		$db2 = $this->M_DBCV->edit_data($where,'karyawan')->result();

		foreach ($db2 as $row2){
		$pdf->Cell(37 ,7,'',0,0);
        $pdf->Cell(37,10,'ID Karyawan',0,0);
        $pdf->Cell(37,10,': '.$row2->ID_Karyawan,0,1);
        $pdf->Cell(37 ,7,'',0,0);
        $pdf->Cell(37,10,'Nama Karyawan',0,0);
        $pdf->Cell(37,10,': '.$row2->Nama_Karyawan,0,1);
        $DtBagian = $row2->ID_Golongan;
    		}
    	// DB Upah
    	$where = array('ID_Golongan' => $DtBagian);
		$db3 = $this->M_DBCV->edit_data($where,'golongan')->result();
		foreach ($db3 as $row3){
		$pdf->Cell(37 ,7,'',0,0);
    	$pdf->Cell(37,10,'Bagian',0,0);
        $pdf->Cell(37,10,': '.$row3->Bagian,0,1);

        $pdf->Cell(37 ,7,'',0,0);
    	$pdf->Cell(37,10,'Upah Harian',0,0);
        $pdf->Cell(37,10,': '.'Rp. '.number_format($row3->Upah_Harian),0,1);
        $pdf->Cell(37 ,7,'',0,0);
    	$pdf->Cell(37,10,'Upah Lembur',0,0);
        $pdf->Cell(37,10,': '.'Rp. '.number_format($row3->Upah_Lembur).'/Hari',0,1);
        	}
    	// DB Penggajian
        
		//Tabel Gaji
		$pdf->Cell(37 ,7,'',0,0);
		$pdf->Cell(37,10,'Tanggal ',0,0);
        $pdf->Cell(37,10,': '.$Dt_Tgl,0,1); 
        $pdf->Cell(15,7,'',0,1);
        // Tabel Penggajian
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Deskripsi',1,0,'C');
		$pdf->Cell(85 ,7,'Keterangan',1,1,'C');
		// $pdf->Cell(34 ,7,'Amount',1,1);//end of line

		$pdf->SetFont('Arial','',12);

		//Angka diratakan kanan, jadi kita beri property 'R'
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Total Masuk',1,0);
		$pdf->Cell(85 ,7,$Dt_Msk,1,1);
		// $pdf->Cell(34 ,7,'3,250',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Total Lembur',1,0);
		$pdf->Cell(85 ,7,$Dt_Lmbr,1,1);
		// $pdf->Cell(34 ,7,'1,200',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'BPJS',1,0);
		$pdf->Cell(85 ,7,'Rp.'.number_format($Dt_Bpjs),1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Snak',1,0);
		$pdf->Cell(85 ,7,'Rp.'.number_format($Dt_Snk),1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Potongan',1,0);
		$pdf->Cell(85 ,7,'Rp.'.number_format($Dt_Ptng),1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Insentive',1,0);
		$pdf->Cell(85 ,7,'Rp.'.number_format($Dt_Instif),1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		
		// Tabel Baru
		$pdf->SetFont('Arial','B',12);
        $pdf->Cell(134 ,7,'',0,0);
		$pdf->Cell(25 ,7,'SubTotal',0,0);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(85 ,7,'Rp.'.number_format($Dt_SubTtl),1,1);
		//end of line
		
		$pdf->SetFont('Arial','B',12);
		 $pdf->Cell(15,7,'',0,1);
		 $pdf->Cell(148 ,7,'',0,0);
		 $pdf->Cell(130 ,7,'Diterima '.date('Y-m-d'),0,0,'C');
		 $pdf->Cell(15,7,'',0,1);
		 $pdf->Cell(15,7,'',0,1);
		 $pdf->Cell(150 ,7,'',0,0);
		 $pdf->Cell(130 ,7,'(         )',0,0,'C');

        $pdf->Output();
}

// function EditPenggajian(){
// 	$IdGaji = $this->input->post('IDGaji');
// 	$id = $this->input->post('IdKaryawan');
// 	$Harian = $this->input->post('UpahHarian'); //Upah Harian
// 	$TtlMasuk = $this->input->post('TotalMasuk'); //Jumlah Masuk
// 	$Lembur = $this->input->post('UpahLembur'); //Upah Lembur
// 	$TtlLembur = $this->input->post('TotalLembur'); //Jumlah Lembur
// 	$Bpjs = $this->input->post('Bpjs');
// 	$Snak = $this->input->post('Snak');
// 	$Insentive = $this->input->post('Insentive');
// 	$Potongan = $this->input->post('Potongan');
// 	$Total = $Harian*$TtlMasuk+$Lembur*$TtlLembur+$Bpjs+$Snak+$Insentive;
// 	$SubTotal = $Total-$Potongan;

// 	$where = array('ID_Gaji' => $IdGaji);
// 	$data = array(
// 		'Snak' => $Snak,
// 		'Potongan' => $Potongan,
// 		'SubTotalupah' => $SubTotal
// 	);
// 	$this->M_DBCV->update_data('penggajian',$data,$where);
// 	redirect(base_url().'SlipGaji');
// }

}
?>