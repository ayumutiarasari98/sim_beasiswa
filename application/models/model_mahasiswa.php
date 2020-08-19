<?php

	class Model_mahasiswa extends CI_Model
	{

		public $table ="tbl_mahasiswa";

		function save($foto)
		{
			$data = array(
				//tabel di database => name di form
				'nrp'           => $this->input->post('nrp', TRUE),
				'nama'          => $this->input->post('nama', TRUE),
				'program_studi' => $this->input->post('program_studi', TRUE),
				'bidang_ahli'   => $this->input->post('bidang_ahli', TRUE),
				'jenis_beasiswa' => $this->input->post('jenis_beasiswa', TRUE),
				'angkatan'	    => $this->input->post('angkatan', TRUE),
				'periode_angkatan'	=> $this->input->post('periode_angkatan', TRUE),
				'durasi_beasiswa'	=> $this->input->post('periode_angkatan', TRUE),
				'file_pks'	=> $this->input->post('periode_angkatan', TRUE),		
				'lama_studi'	    => $this->input->post('lama_studi', TRUE),
				'status_perkuliahan' => $this->input->post('status_perkuliahan', TRUE),
				'status_beasiswa'	 => $this->input->post('status_beasiswa', TRUE),
				'bank'	    => $this->input->post('bank', TRUE),
				'norek'	    => $this->input->post('norek', TRUE),
			);
			$this->db->insert($this->table, $data);

			
		}

		function update()
		{
			
				//update 
				$data = array(
				'nama'          => $this->input->post('nama', TRUE),
				'program_studi' => $this->input->post('program_studi', TRUE),
				'bidang_ahli'   => $this->input->post('bidang_ahli', TRUE),
				'jenis_beasiswa' => $this->input->post('jenis_beasiswa', TRUE),
				'angkatan'	    => $this->input->post('angkatan', TRUE),
				'periode_angkatan'	=> $this->input->post('periode_angkatan', TRUE),
				'durasi_beasiswa'	=> $this->input->post('periode_angkatan', TRUE),
				'file_pks'	=> $this->input->post('periode_angkatan', TRUE),				
				'lama_studi'	    => $this->input->post('lama_studi', TRUE),
				'status_perkuliahan' => $this->input->post('status_perkuliahan', TRUE),
				'status_beasiswa'	 => $this->input->post('status_beasiswa', TRUE),
				'bank'	    => $this->input->post('bank', TRUE),
				'norek'	    => $this->input->post('norek', TRUE),
				);

			$nrp	= $this->input->post('nrp');
			$this->db->where('nrp', $nrp);
			$this->db->update($this->table, $data);
		}

		// Fungsi untuk melakukan proses upload file
	  	public function upload_csv($filename){
		    $this->load->library('upload'); // Load librari upload
		    
		    $config['upload_path'] = './csv/';
		    $config['allowed_types'] = 'csv';
		    $config['max_size']  = '2048';
		    $config['overwrite'] = true;
		    $config['file_name'] = $filename;
		  
		    $this->upload->initialize($config); // Load konfigurasi uploadnya
		    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
		      // Jika berhasil :
		      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
		      return $return;
		    }else{
		      // Jika gagal :
		      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		      return $return;
		    }
		  }
	  
		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
		public function insert_multiple($data){
		    $this->db->insert_batch('tbl_mahasiswa', $data);
		}

	}
	
?>
