<?php
 
	class Prodi extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//checkAksesModule();
			$this->load->library('ssp');
			$this->load->model('model_prodi');
		}

		function data()
		{

			// nama table
			$table      = 'tbl_prodi';
			// nama PK
			$primaryKey = 'kd_prodi';
			// list field yang mau ditampilkan
			$columns    = array(
				//tabel db(kolom di database) => dt(nama datatable di view)
				array('db' => 'kd_prodi', 'dt' => 'kd_prodi'),
		        array('db' => 'nama_prodi', 'dt' => 'nama_prodi'),
		        //untuk menampilkan aksi(edit/delete dengan parameter kode tingkatan)
		        array(
		              'db' => 'kd_prodi',
		              'dt' => 'aksi',
		              'formatter' => function($d) {
		               		return anchor('prodi/edit/'.$d, '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-primary" data-placement="top" title="Edit"').' 
		               		'.anchor('prodi/delete/'.$d, '<i class="fa fa-times fa fa-white"></i>', 'class="btn btn-xs btn-danger" data-placement="top" title="Delete"');
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
			$this->template->load('template', 'prodi/view');
		}

		function add()
		{
			if (isset($_POST['submit'])) {
				$this->model_prodi->save();
				redirect('prodi');
			} else {
				$this->template->load('template', 'prodi/add');
			}
		}

		function edit()
		{
			if (isset($_POST['submit'])) {
				$this->model_prodi->update();
				redirect('prodi');
			} else {
				$kode_prodi		= $this->uri->segment(3);
				$data['prodi']	= $this->db->get_where('tbl_prodi', array('kd_prodi' => $kode_prodi))->row_array();
				$this->template->load('template', 'prodi/edit', $data);
			}
		}

		function delete()
		{
			$kode_prodi = $this->uri->segment(3);
			if (!empty($kode_prodi)) {
				$this->db->where('kd_prodi', $kode_prodi);
				$this->db->delete('tbl_prodi');
			}
			redirect('prodi');
		}

	}

?>