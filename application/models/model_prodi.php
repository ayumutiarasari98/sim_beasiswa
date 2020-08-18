<?php
 
	class Model_prodi extends CI_Model
	{
		
		public $table = "tbl_prodi";

		function save()
		{
			$data = array(
				//tabel di database => name di form
				'kd_prodi'		=> $this->input->post('kd_prodi', TRUE),
				'nama_prodi'	=> $this->input->post('nama_prodi', TRUE)
			);
			$this->db->insert($this->table, $data);
		}

		function update()
		{
			$data = array(
				//tabel di database => name di form
				'nama_prodi'	=> $this->input->post('nama_prodi', TRUE)
			);
			$kode_prodi	= $this->input->post('kd_prodi');
			$this->db->where('kd_prodi', $kode_prodi);
			$this->db->update($this->table, $data);
		}

	} 

?>