<html>
<head>
  <title>Form Import</title>
  
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>
</head>
<body>
  <h3>Form Import</h3>
  <hr>
  
  <a href="<?php echo base_url("csv/import_data.csv"); ?>">Download Format</a>
  <br>
  <br>
  
  <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
  <form method="post" action="<?php echo base_url("mahasiswa/form"); ?>" enctype="multipart/form-data">
    <!-- 
    -- Buat sebuah input type file
    -- class pull-left berfungsi agar file input berada di sebelah kiri
    -->
    <input type="file" name="file">
    
    <!--
    -- Buat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
    -->
    <input type="submit" name="preview" value="Preview">
  </form>
  
  <?php
  if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
    if(isset($upload_error)){ // Jika proses upload gagal
      echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
      die; // stop skrip
    }
    
    // Buat sebuah tag form untuk proses import data ke database
    echo "<form method='post' action='".base_url('mahasiswa/import')."'>";
    
    // Buat sebuah div untuk alert validasi kosong
    echo "<div style='color: red;' id='kosong'>
    Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum terisi semua.
    </div>";
    
    echo "<table border='1' cellpadding='8'>
    <tr>
      <th colspan='5'>Preview Data</th>
    </tr>
    <tr>
      <th>Nrp</th>
      <th>Nama</th>
      <th>Jenjang</th>
      <th>Program Studi</th>
      <th>Bidang Keahlian</th>
      <th>Jenis Beasiswa</th>
      <th>Angkatan</th>
      <th>Periode Angkatan</th>
      <th>Durasi Beasiswa</th>
      <th>File PKS</th>
      <th>Lama Studi</th>
      <th>Status Perkuliahan</th>
      <th>Status Beasiswa</th>
      <th>Bank</th>
      <th>No Rekening</th>

    </tr>";
    
    $numrow = 1;
    $kosong = 0;
    
    // Lakukan perulangan dari data yang ada di csv
    // $sheet adalah variabel yang dikirim dari controller
    foreach($sheet as $row){ 
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
        $nrp = $get[0]; // Ambil data NIS dari kolom A di csv
		    $nama = $get[1]; // Ambil data nama dari kolom B di csv
		    $jenjang = $get[2]; 
				$prodi = $get[3]; 
				$bidang_keahlian = $get[4]; 
				$jenis_beasiswa = $get[5]; 
				$angkatan = $get[6]; 
				$periode_angkatan = $get[7]; 
				$durasi_beasiswa = $get[8]; 
				$file_pks = $get[9]; 
				$lama_studi = $get[10]; 
				$status_perkuliahan = $get[11]; 
				$status_beasiswa = $get[12]; 
				$bank = $get[13]; 
				$norek = $get[14]; 
      
      // Cek jika semua data tidak diisi
      if(empty($nim) && empty($nama) && empty($jenjang) && empty($prodi) && empty($bidang_keahlian) && empty($jenis_beasiswa) && empty($angkatan) && empty($periode_angkatan) && empty($durasi_beasiswa) && empty($file_pks) && empty($lama_studi) && empty($status_perkuliahan) && empty($status_beasiswa) && empty($bank) && empty($norek))
        continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
      
      // Cek $numrow apakah lebih dari 1
      // Artinya karena baris pertama adalah nama-nama kolom
      // Jadi dilewat saja, tidak usah diimport
      if($numrow > 1){
        // Validasi apakah semua data telah diisi
        $nim_td = ( ! empty($nim))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
        $nama_td = ( ! empty($nama))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
        $jenjang_td = ( ! empty($jenjang))? "" : " style='background: #E07171;'"; 
        $bidang_keahlian_td = ( ! empty($bidang_keahlian))? "" : " style='background: #E07171;'"; 
        $jenis_beasiswa_td = ( ! empty($jenis_beasiswa))? "" : " style='background: #E07171;'"; 
        $angkatan_td = ( ! empty($angkatan))? "" : " style='background: #E07171;'"; 
        $periode_angkatan_td = ( ! empty($periode_angkatan))? "" : " style='background: #E07171;'"; 
        $durasi_beasiswa_td = ( ! empty($durasi_beasiswa))? "" : " style='background: #E07171;'"; 
        $file_pks_td = ( ! empty($file_pks))? "" : " style='background: #E07171;'"; 
        $lama_studi_td = ( ! empty($lama_studi))? "" : " style='background: #E07171;'"; 
        $status_perkuliahan_td = ( ! empty($status_perkuliahan))? "" : " style='background: #E07171;'"; 
        $status_beasiswa_td = ( ! empty($status_beasiswa))? "" : " style='background: #E07171;'"; 
        $bank_td = ( ! empty($bank))? "" : " style='background: #E07171;'"; 
        $norek_td = ( ! empty($norek))? "" : " style='background: #E07171;'"; 
        
        // Jika salah satu data ada yang kosong
        if(empty($nim) or empty($nama) or empty($jenjang) or empty($prodi) or empty($bidang_keahlian) or empty($jenis_beasiswa) or empty($angkatan) or empty($periode_angkatan) or empty($durasi_beasiswa) or empty($file_pks) or empty($lama_studi) or empty($status_perkuliahan) or empty($status_beasiswa) or empty($bank) or empty($norek)){
          $kosong++; // Tambah 1 variabel $kosong
        }
        
        echo "<tr>";
        echo "<td".$nim_td.">".$nim."</td>";
        echo "<td".$nama_td.">".$nama."</td>";
        echo "<td".$jenjang_td.">".$jenjang."</td>";
        echo "<td".$bidang_keahlian_td.">".$bidang_keahlian."</td>";
        echo "<td".$jenis_beasiswa_td.">".$jenis_beasiswa."</td>";
        echo "<td".$angkatan_td.">".$angkatan."</td>";
        echo "<td".$periode_angkatan_td.">".$periode_angkatan."</td>";
        echo "<td".$durasi_beasiswa_td.">".$durasi_beasiswa."</td>";
        echo "<td".$file_pks_td.">".$file_pks."</td>";
        echo "<td".$lama_studi_td.">".$lama_studi."</td>";
        echo "<td".$status_perkuliahan_td.">".$status_perkuliahan."</td>";
        echo "<td".$status_beasiswa_td.">".$status_beasiswa."</td>";
        echo "<td".$bank_td.">".$bank."</td>";
        echo "<td".$norek_td.">".$norek."</td>";

        echo "</tr>";
      }
      
      $numrow++; // Tambah 1 setiap kali looping
    }
    
    echo "</table>";
    
    // Cek apakah variabel kosong lebih dari 1
    // Jika lebih dari 1, berarti ada data yang masih kosong
    if($kosong > 1){
    ?>  
      <script>
      $(document).ready(function(){
        // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
        $("#jumlah_kosong").html('<?php echo $kosong; ?>');
        
        $("#kosong").show(); // Munculkan alert validasi kosong
      });
      </script>
    <?php
    }else{ // Jika semua data sudah diisi
      echo "<hr>";
      
      // Buat sebuah tombol untuk mengimport data ke database
      echo "<button type='submit' name='import'>Import</button> ";
      echo "<a href='".base_url("mahasiswa")."'>Cancel</a>";
    }
    
    echo "</form>";
  }
  ?>
</body>
</html>