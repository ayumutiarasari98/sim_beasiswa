<?php

	class Tampilan_utama extends CI_Controller
	{
		
		function index()
		{
			$quser = 'SELECT COUNT(*) AS hasil FROM tbl_user';
			$data['user'] = $this->db->query($quser)->row_array();

			$qsiswa = 'SELECT COUNT(*) AS hasil FROM tbl_mahasiswa';
			$data['siswa'] = $this->db->query($qsiswa)->row_array();

			$qsiswa = 'SELECT COUNT(*) AS hasil FROM tbl_beasiswa';
			$data['beasiswa'] = $this->db->query($qsiswa)->row_array();


			$this->template->load('template', 'dashboard', $data);
		}

	}

?>