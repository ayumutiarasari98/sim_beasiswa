<?php
 
	class Model_beasiswa extends CI_Model
	{
		
		public $table = "tbl_beasiswa";

		function save()
		{
			$data = array(
				//tabel di database => name di form
				'kd_beasiswa'            => $this->input->post('kd_kelas', TRUE),
				'nama_beasiswa'          => $this->input->post('nama_beasiswa', TRUE),
				'pemberi_beasiswa'		  => $this->input->post('pemberi_beasiswa', TRUE),
				'detail_beasiswa'		  => $this->input->post('detail_beasiswa', TRUE)
			);
			$this->db->insert($this->table, $data);
		}

		function update()
		{
			$data = array(
				//tabel di database => name di form
				'nama_beasiswa'          => $this->input->post('nama_kelas', TRUE),
				'pemberi_beasiswa'		  => $this->input->post('pemberi_beasiswa', TRUE),
				'detail_beasiswa'		  => $this->input->post('detail_beasiswa', TRUE)
			);
			$kode_beasiswa	= $this->input->post('kd_beasiswa');
			$this->db->where('kd_beasiswa', $kode_beasiswa);
			$this->db->update($this->table, $data);
		}

	}

?>