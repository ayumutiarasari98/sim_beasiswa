<?php

	class Beasiswa extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//checkAksesModule();
			$this->load->library('ssp');
			$this->load->model('model_beasiswa');
		}

		function data()
		{
			// $sql = "SELECT tk.*, ttk.nama_tingkatan, tj.nama_jurusan 
			// FROM tbl_kelas AS tk, tbl_tingkatan_kelas AS ttk, tbl_jurusan AS tj 
			// WHERE tk.kd_tingkatan = ttk.kd_tingkatan AND tk.kd_jurusan = tj.kd_jurusan"
			// Biasanya menggunakan query untuk mengambil nama dari tabel yang berbeda tapi saling berelasi,
			// karena terlalu panjang, harus menggunakan foreach lagi dan menurut saya sepertinya 
			//tidak bisa melakukan foreach di datatable, maka saya menggunaka create view kita bisa membuat query tersebut menjadi sebuah table

			// nama table
			$table      = 'tbl_beasiswa';
			// nama PK
			$primaryKey = 'kd_beasiswa';
			// list field yang mau ditampilkan
			$columns    = array(
				//tabel db(kolom di database) => dt(nama datatable di view)
				array('db' => 'kd_beasiswa', 'dt' => 'kd_beasiswa'),
		        array('db' => 'nama_beasiswa', 'dt' => 'nama_beasiswa'),
		        array('db' => 'pemberi_beasiswa', 'dt' => 'pemberi_beasiswa'),
		        array('db' => 'detail_beasiswa', 'dt' => 'detail_beasiswa'),
		        //untuk menampilkan aksi(edit/delete dengan parameter kode kelas)
		        array(
		              'db' => 'kd_beasiswa',
		              'dt' => 'aksi',
		              'formatter' => function($d) {
		               		return anchor('beasiswa/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
		               		'.anchor('beasiswa/delete/'.$d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger" data-placement="top" title="Delete"');
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
			$this->template->load('template', 'beasiswa/view');
		}

		function add()
		{
			if (isset($_POST['submit'])) {
				$this->model_beasiswa->save();
				redirect('beasiswa');
			} else {
				$this->template->load('template', 'beasiswa/add');
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) {
				$this->model_beasiswa->update();
				redirect('beasiswa');
			} else {
				$kd_beasiswa 		= $this->uri->segment(3);
				$data['beasiswa']	= $this->db->get_where('tbl_beasiswa', array('kd_beasiswa' => $kd_beasiswa))->row_array();
				$this->template->load('template', 'beasiswa/edit', $data);
			}
		}

		function delete()
		{
			$kode_beasiswa = $this->uri->segment(3);
			if (!empty($kode_beasiswa)) {
				$this->db->where('kd_beasiswa', $kode_beasiswa);
				$this->db->delete('tbl_beasiswa');
			}
			redirect('beasiswa');
		}


		// siswa_aktif() -> untuk menampilkan view peserta didik ->terletak di controller Siswa
		// combobox_kelas() -> untuk menampilkan data kelas sesuai jurusan yang dipilih -> terletak di controller Kelas
		// loadDataSiswa() -> untuk menampilkan data siswa nim dan nama sesuai kode_kelas yang dipilih di filter, lalu ditampilkan ke div id = kelas yang bedada di view/siswa_aktif -> terletak di controller Siswa
		

	}

?>