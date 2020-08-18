<?php

	class Mahasiswa extends CI_Controller
	{
		private $filename = "import_data"; // nama file .csv
		
		function __construct() 
		{
			parent::__construct();
			//checkAksesModule();
			$this->load->library('ssp');
			$this->load->model('model_mahasiswa');
		}

		function data()
		{

			// nama table
			$table      = 'tbl_mahasiswa';
			// nama PK
			$primaryKey = 'nrp';
			// list field yang mau ditampilkan
			$columns    = array(
				array('db' => 'nrp', 'dt' => 'nrp'),
		        array('db' => 'nama', 'dt' => 'nama'),
		        array('db' => 'program_studi', 'dt' => 'program_studi'),
				array('db' => 'bidang_ahli', 'dt' => 'bidang_ahli'),
				array('db' => 'jenis_beasiswa', 'dt' => 'jenis_beasiswa'),
				array('db' => 'angkatan', 'dt' => 'angkatan'),
				array('db' => 'periode_angkatan', 'dt' => 'periode_angkatan'),
				array('db' => 'lama_studi', 'dt' => 'lama_studi'),
				array('db' => 'status_perkuliahan', 'dt' => 'status_perkuliahan'),
				array('db' => 'status_beasiswa', 'dt' => 'status_beasiswa'),
				array('db' => 'bank', 'dt' => 'bank'),
				array('db' => 'norek', 'dt' => 'norek'),
		        //untuk menampilkan aksi(edit/delete dengan parameter nim siswa)
		        array(
		              'db' => 'nrp',
		              'dt' => 'aksi',
		              'formatter' => function($d) {
		               		return anchor('mahasiswa/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
		               		'.anchor('mahasiswa/delete/'.$d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger" data-placement="top" title="Delete"');
		            }
		        )
		    );

			$sql_details = array(
				'user' => $this->db->username,
				'pass' => $this->db->password,
				'db'   => $this->db->database,
				'host' => $this->db->hostname
		    );

		    echo json_encode(
		     	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
		     );

		}

		function index()
		{
			$this->template->load('template', 'mahasiswa/view');
		}

		function add()
		{
			if (isset($_POST['submit'])) {
				$this->model_mahasiswa->save();
				redirect('mahasiswa');
			} else {
				$this->template->load('template', 'mahasiswa/add');
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) {
				$this->model_mahasiswa->update();
				redirect('mahasiswa');
			} else {
				$nrp           = $this->uri->segment(3);
				$data['mahasiswa'] = $this->db->get_where('tbl_mahasiswa', array('nrp' => $nrp))->row_array();
				$this->template->load('template', 'mahasiswa/edit', $data);
			}
		}

		function delete()
		{
			$nrp = $this->uri->segment(3);
			if (!empty($nrp)) {
				$this->db->where('nim', $nrp);
				$this->db->delete('tbl_mahasiswa');
			} 
			redirect('mahasiswa');
		}

		
		// siswa_aktif() -> untuk menampilkan view peserta didik ->terletak di controller Siswa
		// combobox_kelas() -> untuk menampilkan data kelas sesuai jurusan yang dipilih -> terletak di controller Kelas
		// loadDataSiswa() -> untuk menampilkan data siswa nim dan nama sesuai kode_kelas yang dipilih di filter, lalu ditampilkan ke div id = kelas yang bedada di view/siswa_aktif -> terletak di controller Siswa
		function siswa_aktif()
		{
			$this->template->load('template', 'mahasiswa/siswa_aktif');
		}

		// function loadDataSiswa()
		// {
		// 	$kelas 	= $_GET['kd_beasiswa'];

		// 	//echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
		// 	//		<tr>
		// 	//			<th width=100 class='text-center'>NIM</th>
		// 	//			<th>NAMA</th>
		// 	//			<th class='text-center'>NILAI</th>
		// 	//		</tr>";

		// 	$this->db->where('kd_kelas', $kelas);
		// 	$siswa = $this->db->get('tbl_siswa');
		// 	foreach ($siswa->result() as $row) {
		// 		echo "<tr>
		// 				<td class='text-center'>$row->nim</td>
		// 				<td>$row->nama</td>
		// 				<td class='text-center'>".anchor('siswa/nilai_siswa/'.$row->nim, '<i class="fa fa-eye" aria-hidden="true"></i>')."</td>
		// 			 </tr>";
		// 	}
		// 	echo "</table>";
		// }

		function export_excel()
		{
			$this->load->library('CPHP_excel');
	        $objPHPExcel = new PHPExcel();
	        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'NIM');
	        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'SISWA');
	        
	        $kelas = $_POST['kelas'];
	        $this->db->where('kd_kelas', $kelas);
	        $siswa = $this->db->get('tbl_siswa');
	        $no=2;
	        foreach ($siswa->result() as $row){
	            $objPHPExcel->getActiveSheet()->setCellValue('A'.$no, $row->nim);
	            $objPHPExcel->getActiveSheet()->setCellValue('B'.$no, $row->nama);
	            $no++;
	        }
	        
	        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
	        $objWriter->save("data-siswa.xlsx");
	        $this->load->helper('download');
	        force_download('data-siswa.xlsx', NULL);
		}

		

		function form(){
		    $data = array(); // Buat variabel $data sebagai array
		    
		    if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
		      // lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		      $uploadcsv = $this->model_siswa->upload_csv($this->filename);
		      
		      if($uploadcsv['result'] == "success"){ // Jika proses upload sukses
		        // Load plugin PHPExcel nya
		        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		        
		        $csvreader = PHPExcel_IOFactory::createReader('CSV');
		        $loadcsv = $csvreader->load('csv/'.$this->filename.'.csv'); // Load file yang tadi diupload ke folder csv
		        $sheet = $loadcsv->getActiveSheet()->getRowIterator();
		        
		        // Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
		        // Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam csv yang sudha di upload sebelumnya
		        $data['sheet'] = $sheet; 
		      }else{ // Jika proses upload gagal
		        $data['upload_error'] = $uploadcsv['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		      }
		    }
		    
		    $this->load->view('siswa/form', $data);
		  }

		  function import(){
		  	// Load plugin PHPExcel nya
		  	include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		    
		    $csvreader = PHPExcel_IOFactory::createReader('CSV');
		    $loadcsv = $csvreader->load('csv/'.$this->filename.'.csv'); // Load file yang tadi diupload ke folder csv
		    $sheet = $loadcsv->getActiveSheet()->getRowIterator();
		    
		    // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		    $data = [];
		    
		    $numrow = 1;
		    foreach($sheet as $row){
		      // Cek $numrow apakah lebih dari 1
		      // Artinya karena baris pertama adalah nama-nama kolom
		      // Jadi dilewat saja, tidak usah diimport
		      if($numrow > 1){
		        // START -->
		        // Skrip untuk mengambil value nya
		        $cellIterator = $row->getCellIterator();
		        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
		        
		        $get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
		        foreach ($cellIterator as $cell) {
		          array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
		        }
		        // <-- END
		        
		        // Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
		        $nim = $get[0]; // Ambil data NIS dari kolom A di csv
		        $nama = $get[1]; // Ambil data nama dari kolom B di csv
		        $tanggal_lahir = $get[2]; // Ambil data jenis kelamin dari kolom C di csv
		        $tempat_lahir = $get[3]; // Ambil data alamat dari kolom D di csv
		        
		        // Kita push (add) array data ke variabel data
		        array_push($data, [
		          'nim'=>$nim, // Insert data nis
		          'nama'=>$nama, // Insert data nama
		          'tanggal_lahir'=>$tanggal_lahir, // Insert data jenis kelamin
		          'tempat_lahir'=>$tempat_lahir, // Insert data alamat
		        ]);
		      }
		      
		      $numrow++; // Tambah 1 setiap kali looping
		    }
		    // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		    $this->model_siswa->insert_multiple($data);
		    
		    redirect("Siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
		  }

		  function naik_kelas() {
		  	$this->template->load('template', 'siswa/naik_kelas');
		  }

		  function Naiksiswa()
			{
				$kelas 	= $_GET['kd_kelas'];

				echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
						<tr>
							<th width=100 class='text-center'>NIM</th>
							<th>NAMA</th>
						</tr>";

				$this->db->where('kd_kelas', $kelas);
				$siswa = $this->db->get('tbl_siswa');
				foreach ($siswa->result() as $row) {
					echo "<tr>
							<td class='text-center'>$row->nim</td>
							<td>$row->nama</td>
						 </tr>";
				}
				echo "</table>";
			}

		function aksi_naikkelas() {
			$kelas 	= $_GET['kelas'];
			$this->db->where('kd_kelas', $kelas);
			$siswa = $this->db->get('tbl_siswa');
			foreach ($siswa->result() as $row) {
				$nim = $row->nim;
				print($nim);
			}
			//$querynaik = "UPDATE tbl_siswa SET kd_kelas = '8-A1' WHERE NIM = '18SI1000' AND kd_kelas = '$kelas'"
		}

		// function loadDataSiswa()
		// {
		// 	$kelas 	= $_GET['kd_kelas'];

		// 	echo "<table class='table table-striped table-bordered table-hover table-full-width dataTable'>
		// 			<tr>
		// 				<th width=100 class='text-center'>NIM</th>
		// 				<th>NAMA</th>
		// 				<th class='text-center'>NILAI</th>
		// 			</tr>";

		// 	$this->db->where('kd_kelas', $kelas);
		// 	$siswa = $this->db->get('tbl_siswa');
		// 	foreach ($siswa->result() as $row) {
		// 		echo "<tr>
		// 				<td class='text-center'>$row->nim</td>
		// 				<td>$row->nama</td>
		// 				<td class='text-center'>".anchor('siswa/nilai_siswa/'.$row->nim, '<i class="fa fa-eye" aria-hidden="true"></i>')."</td>
		// 			 </tr>";
		// 	}
		// 	echo "</table>";
		// }

	}

?>