<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PageHome extends CI_Controller {
function __construct(){
	parent::__construct();
	$this->load->library('Excel');
	$this->load->library('pdf');
	$this->load->library('QR');
	if($this->session->userdata('status')!= "AdminSuper"){
      redirect(base_url().'LogOut');
    }
}

function index(){
	$db = date('Y-m');
	$Penggajian = $this->M_DBCV->JumlahGaji($db);
	$Data['Karyawan'] = $this->M_DBCV->get_data('karyawan')->num_rows();
	$Data['Gaji'] = $Penggajian/$Data['Karyawan']*100;
	$Data['total'] = $this->M_DBCV->hitungJumlah($db);
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Header',$data);
	$this->load->view('Dashboard',$Data);
	$this->load->view('Footer');
}

function EditPengguna(){
	$ID = $this->input->post('ID');
	$Pass = $this->input->post('Password');

	$where = array('ID_Karyawan' => $ID);
	$data = array(
		'Password' => $Pass
	);
	$this->M_DBCV->update_data('user',$data,$where);
	redirect(base_url().'PageHome');
}

  // ================== From Karyawan ====================
function Karyawan(){
	$data['Karyawan'] = $this->M_DBCV->get_data('karyawan')->result();
	$data['kodeKary'] = $this->M_DBCV->kode_Karyawan();
	$data['Bagian'] = $this->M_DBCV->get_Bagian();
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Header',$data);
	$this->load->view('DataKaryawan',$data);
	$this->load->view('mainModal/AddKaryawan',$data);
	$this->load->view('Footer');
}

function EditKaryawan(){
		$ID = $this->input->post('ID');
		$Nama = $this->input->post('nama');
		$Tgl_lhir = $this->input->post('tgl');
		$Almt = $this->input->post('alamat');
		$Jabatan = $this->input->post('Bagian');
	
		$where = array('ID_Karyawan' => $ID);
			$data = array(
				'ID_Karyawan' => $ID,
				'Nama_Karyawan' => $Nama,
				'ID_Golongan' => $Jabatan,
				'Tgl_Lahir' => $Tgl_lhir,
				'Alamat' => $Almt
			);
		$this->M_DBCV->update_data('karyawan',$data,$where);
		redirect('Karyawan');
}

function AddKaryawan(){
	$ID = $this->input->post('ID');
	$Nama = $this->input->post('NamaKary');
	$Tgl_Msk = $this->input->post('Tgl');
	$Tgl_lhir = $this->input->post('tgl_lahir');
	$Almt = $this->input->post('Alamat');
	$Jabatan = $this->input->post('Bagian');

	$data = array(
		'ID_Karyawan' => $ID,
		'Nama_Karyawan' => $Nama,
		'ID_Golongan' => $Jabatan,
		'Tgl_Lahir' => $Tgl_lhir,
		'Tgl_Masuk' => $Tgl_Msk,
		'Alamat' => $Almt
	);
	$this->M_DBCV->insert_data($data,'karyawan');
	redirect(base_url().'Karyawan');
}

function HapusKaryawan(){
	$id = $this->input->post('ID');
	$where = array('ID_Karyawan' => $id);
	unlink("./temp/".$id.".png");//hapus png QR
	$this->M_DBCV->delete_data($where,'karyawan');
	redirect('Karyawan');
}

 // ======================== From Jabatan =========================
function Jabatan(){
	$data['Upah'] = $this->M_DBCV->get_data('golongan')->result();
	$data['data'] = $this->M_DBCV->buat_kode();
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Header',$data);
	$this->load->view('DataJabatan',$data);
	$this->load->view('mainModal/AddJabatan',$data);
	$this->load->view('Footer');
}

function AddJabatan(){
	$ID = $this->input->post('ID');
	$bagian = $this->input->post('bagian');
	$Upah1 = $this->input->post('Upah_Harian');
	$Upah2 = $this->input->post('Upah_Lembur');
	$BPJS = $this->input->post('Bpjs');
	$inst = $this->input->post('insentive');

	$data = array(
		'ID_Golongan' => $ID,
		'Bagian' => $bagian,
		'Upah_Harian' => $Upah1,
		'Upah_Lembur' => $Upah2,
		'Bpjs' => $BPJS,
		'Insentive' => $inst
	);
	$this->M_DBCV->insert_data($data,'golongan');
	redirect(base_url().'Jabatan');
}

function EditJabatan(){
	$ID = $this->input->post('ID');
	$bagian = $this->input->post('bagian');
	$Upah1 = $this->input->post('UpahHarian');
	$Upah2 = $this->input->post('Lembur');
	$inst = $this->input->post('insentive');
	$BPJS = $this->input->post('Bpjs');

	$where = array('ID_Golongan' => $ID);
	$data = array(
		'ID_Golongan' => $ID,
		'Bagian' => $bagian,
		'Upah_Harian' => $Upah1,
		'Upah_Lembur' => $Upah2,
		'Bpjs' => $BPJS,
		'Insentive' => $inst
	);
	$this->M_DBCV->update_data('golongan',$data,$where);
	redirect('Jabatan');
}

function HapusJabatan(){
	$id = $this->input->post('ID');
	$where = array('ID_Golongan' => $id);
	$this->M_DBCV->delete_data($where,'golongan');
	redirect('Jabatan');
}

 // =========================== From Pengguna ========================
function Pengguna(){
	$data['ID'] = $this->M_DBCV->KodeUser();
	$data['User'] = $this->M_DBCV->get_data('user')->result();
	$data['DBKaryawan'] = $this->M_DBCV->get_User(); // input data user
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Header',$data);
	$this->load->view('DataPengguna',$data);
	$this->load->view('mainModal/AddPengguna',$data);
	$this->load->view('Footer');
}

function get_nama(){
	$id=$this->input->post('id');
	$data=$this->M_DBCV->get_subkategori($id);
	echo json_encode($data);
}

function AddPengguna(){
	$ID = $this->input->post('ID');
	$id = $this->input->post('ID_Golongan');
	$Nama = $this->input->post('ID_Karyawan');
	$Status = 1;
	$where = array('ID_Karyawan' => $Nama);
	$DB = $this->M_DBCV->edit_data($where,'karyawan')->result();
	foreach($DB as $b){
		$Pass = password_hash($b->Tgl_lahir, PASSWORD_DEFAULT);
	}

	$data = array(
		'Id_User' => $ID,
		'ID_Grup' => $id,
		'ID_Karyawan' => $Nama,
		'Password' => $Pass,
		'Status' => $Status
	);
	$this->M_DBCV->insert_data($data,'user');
	redirect(base_url().'Pengguna');
}

function HapusPengguna(){
	$id = $this->input->post('ID');
	$where = array('ID_User' => $id);
	$this->M_DBCV->delete_data($where,'user');
	redirect('Pengguna');
}


 // ========================== From Laporan ======================
function Laporan(){
	// $data['keyword'] = "2019-09";
	$data['keyword'] = date('Y-m');
	$data['Gaji'] = $this->M_DBCV->Tampil_Data($data['keyword']);
	$data['total'] = $this->M_DBCV->hitungJumlah($data['keyword']);
	$data['user'] = $this->M_DBCV->get_data('user')->result();
	$this->load->view('Header',$data);
	$this->load->view('Laporan',$data);
	$this->load->view('Footer');
}

function SlipGaji(){
	$DBSlip = $this->input->post('InputSlip');
	if ($DBSlip<10) {
		$tahun = date('Y-0');
	}else{
		$tahun = date('Y-');
	}
	$data['keyword'] = $tahun.$DBSlip;
	$data['Gaji'] = $this->M_DBCV->Tampil_Data($data['keyword']);
	$data['total'] = $this->M_DBCV->hitungJumlah($data['keyword']);
	$data['user'] = $this->M_DBCV->get_data('karyawan')->result();
	$this->load->view('Header',$data);
	$this->load->view('Laporan',$data);
	$this->load->view('Footer');
}

function InportExcel($Id){
	
	// Panggil class PHPExcel nya
		$excel = new PHPExcel();

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('By Widianto')
							   ->setLastModifiedBy('CV. HIKARI TECHNOLOGY')
							   ->setTitle("Laporan Penggajian")
							   ->setSubject("Penggajian")
							   ->setDescription("Laporan Penggajian")
							   ->setKeywords("Laporan Penggajian");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN Penggajian | ".$Id); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "ID Karyawan"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "Tgl Transaksi"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "Total Masuk"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "Total Lembur"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "BPJS"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "Snak"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Potongan"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "Insentive"); // Set kolom E3 dengan tulisan "ALAMAT"
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "Total Gaji"); // Set kolom E3 dengan tulisan "ALAMAT"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		// $Gaji = $this->SiswaModel->view();
		$keyword = $Id;
		$Gaji = $this->M_DBCV->Tampil_Data($keyword);

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($Gaji as $data){ // Lakukan looping pada variabel siswa
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->ID_Karyawan);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->Tgl_Transaksi);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->Total_Masuk);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->Total_Lembur);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->BPJS);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->Snak);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->Potongan);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->Insentive);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->SubTotalupah);
			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			
			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(12); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(12); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Penggajian|".$Id);
		$excel->setActiveSheetIndex(0);

		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Laporan Penggajian'.$Id.'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');	
}

function SavePdf($id){
	$pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(280,7,'CV. HIKARI TECHNOLOGY',0,1,'C');
        $pdf->SetFont('Arial','B',14);
        $pdf->Cell(280,7,'Laporan Pengajian',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(15,7,'',0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(15,7,'',0,1);
		
		//Tabel Gaji
		$Tanggal = date('d-m-Y');// Y-m-d
		$pdf->Cell(13 ,7,'',0,0);
		$pdf->Cell(37,10,'Tanggal ',0,0);
        $pdf->Cell(37,10,': '.$Tanggal,0,1); 
        $pdf->Cell(15,7,'',0,1);
        // Tabel Penggajian

		$pdf->SetFont('Arial','B',12);
		// $pdf->Cell(1 ,7,'',0,0);
		$pdf->Cell(33 ,7,'ID Karyawan',1,0,'C');
		$pdf->Cell(25 ,7,'Ttl Masuk',1,0,'C');
		$pdf->Cell(25 ,7,'Ttl Lembur',1,0,'C');
		$pdf->Cell(33 ,7,'Transaksi',1,0,'C');
		$pdf->Cell(33 ,7,'Snak',1,0,'C');
		$pdf->Cell(33 ,7,'Insentive',1,0,'C');
		$pdf->Cell(33 ,7,'BPJS',1,0,'C');
		$pdf->Cell(33 ,7,'Potongan',1,0,'C');
		$pdf->Cell(33 ,7,'Total Gaji',1,1,'C');
		// $pdf->Cell(85 ,7,'Deskripsi',1,0,'C');
		// $pdf->Cell(34 ,7,'Amount',1,1);//end of line
		$db = $this->M_DBCV->Tampil_Data($id);
		$Dt_Total = $this->M_DBCV->hitungJumlah($id);
		
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

		$pdf->SetFont('Arial','',12);

		//Angka diratakan kanan, jadi kita beri property 'R'
		// $pdf->Cell(1 ,7,'',0,0);
		$pdf->Cell(33 ,7,$Dt_Kry,1,0,'C');
		$pdf->Cell(25 ,7, $Dt_Msk,1,0,'C');
		$pdf->Cell(25 ,7,$Dt_Lmbr,1,0,'C');
		$pdf->Cell(33 ,7, $Dt_Tgl,1,0,'C');
		$pdf->Cell(33 ,7,'Rp.'.number_format($Dt_Snk),1,0,'C');
		$pdf->Cell(33 ,7,'Rp.'.number_format($Dt_Instif),1,0,'C');
		$pdf->cell(33,7,'Rp.'.number_format($Dt_Bpjs),1,0,'C');
		$pdf->cell(33,7,'Rp.'.number_format($Dt_Ptng),1,0,'C');
		$pdf->Cell(33 ,7,'Rp.'.number_format($Dt_SubTtl),1,1,'C');
		}
		
		// Tabel Baru
		$pdf->SetFont('Arial','B',12);
        // $pdf->Cell(1 ,7,'',0,0);
		$pdf->Cell(248 ,7,'SubTotal',1,0,'C');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(33 ,7,'Rp.'.number_format($Dt_Total),1,1,'C');
		//end of line
		
		$pdf->SetFont('Arial','B',12);
		 $pdf->Cell(15,7,'',0,1);
		 $pdf->Cell(150 ,7,'',0,0);
		 $pdf->Cell(15,7,'',0,0);
		 $pdf->Cell(15,7,'',0,0);
		 $pdf->Cell(130 ,7,'Diterima',0,1,'C');
		 $pdf->Cell(150 ,7,'',0,0);
		 $pdf->Cell(189 ,7,'(         )',0,1,'C');

        $pdf->Output();
}

function QRTes($id){
	//Nama Folder file QR Code kita nantinya akan disimpan
	$id = $id;
    $tempdir = "temp/";

    //jika folder belum ada, buat folder 
    if (!file_exists($tempdir)){
        mkdir($tempdir);
    }
    $isi_teks = $id;
    $namafile = $isi_teks.".png";
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 7; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);
    redirect('PageHome/QRKaryawan/'.$id);
}

function QRKaryawan($id){
	
	$pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
	$pdf->AddPage();
        // setting jenis font yang akan digunakan
	$pdf->SetFont('Arial','B',16);
        // mencetak string 
	$pdf->Cell(290,7,'CV. HIKARI TECHNOLOGY',0,2,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(290,7,'Data Karyawan',0,1,'C');
        // Memberikan space kebawah agar tidak terlalu rapat
	$pdf->Cell(15,7,'',0,1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,7,'',0,1);
		//Data Karyawan
	$where = array('ID_Karyawan' => $id);
	$db = $this->M_DBCV->edit_data($where,'karyawan')->result();

	foreach ($db as $row){
		$ID = $row->ID_Karyawan;
		$Nama = $row->Nama_Karyawan;
		$TglLahir = $row->Tgl_Lahir;
		$TglMasuk = $row->Tgl_Masuk;
		$Alamat = $row->Alamat;
		$IdGolongan = $row->ID_Golongan;
	}

	$where = array('ID_Golongan' => $IdGolongan);
	$data = $this->M_DBCV->edit_data($where,'golongan')->result();
	foreach ($data as $key) {
		$Bagian = $key->Bagian;
	}

		// Tabel data Karyawan
		$pdf->SetFont('Arial','B',12);

		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Deskripsi',1,0,'C');
		$pdf->Cell(85 ,7,'Keterangan',1,1,'C');
		// $pdf->Cell(34 ,7,'Amount',1,1);//end of line

		$pdf->SetFont('Arial','',12);

		//Angka diratakan kanan, jadi kita beri property 'R'
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Id Karyawan',1,0);
		$pdf->Cell(85 ,7,$ID,1,1);
		// $pdf->Cell(34 ,7,'3,250',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Nama Karyawan',1,0);
		$pdf->Cell(85 ,7,$Nama,1,1);
		// $pdf->Cell(34 ,7,'1,200',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Tanggal Lahir',1,0);
		$pdf->Cell(85 ,7,$TglLahir,1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Tanggal Masuk',1,0);
		$pdf->Cell(85 ,7,$TglMasuk,1,1);
		// $pdf->Cell(34 ,7,'1,000',1,1,'R');//end of line
		$pdf->Cell(29 ,7,'',0,0);
		$pdf->Cell(130 ,7,'Bagian',1,0);
		$pdf->Cell(85 ,7,$Bagian,1,1);
		
		//Kode QR Karyawan
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(29 ,7,'',0,1);
		$pdf->Cell(29 ,7,'',0,1);
		$pdf->Cell(29 ,7,'',0,1);
		$pdf->Cell(290,7,'QR Karyawan',0,0,'C');

		// Gambar QR
		$pdf->Image('./temp/'.$ID.'.png',120,110,70,50);
		//end of line

	$pdf->Output();
}

}