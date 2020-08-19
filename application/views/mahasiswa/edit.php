<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Mahasiswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open_multipart('mahasiswa/edit', 'role="form" class="form-horizontal"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">NRP</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['nrp']; ?>" readonly="true" name="NRP" class="form-control" placeholder="Masukkan NRP">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['nama']; ?>" name="nama" class="form-control" placeholder="Masukkan Nama Lengkap">
                      </div>
                  </div>


                  <div class="form-group">
                      <label class="col-sm-2 control-label">Jenjang</label>

                      <div class="col-sm-5">
                      <?php
                          echo form_dropdown('jenjang', array('Pilih Jenjang', 'S1'=>'Sarjana', 'S2'=>'Magister', 'S3'=>'Doktor'), null, "class='form-control'");
                        ?>
                      </div>
                  </div>

                 
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Program Studi</label>

                      <div class="col-sm-5">
                        <?php
                          echo cmb_dinamis('prodi', 'tbl_prodi', 'nama_prodi', 'kd_prodi');
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Bidang Keahlian</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['bidang_keahlian']; ?>" name="bidang_keahlian" class="form-control" placeholder="Masukkan Bidang Keahlian">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Jenis Beasiswa</label>

                      <div class="col-sm-5">
                        <?php
                          echo cmb_dinamis('beasiswa', 'tbl_beasiswa', 'nama_beasiswa', 'kd_beasiswa');
                        ?>
                      </div>
                  </div>


                  <div class="form-group">
                  <label class="col-sm-2 control-label">Angkatan</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['angkatan']; ?>" name="angkatan" class="form-control" placeholder="Angkatan">
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Periode Angkatan</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['periode_angkatan']; ?>" name="periode_angkatan" class="form-control" placeholder="Periode Angkatan">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Durasi Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['durasi_beasiswa']; ?>" name="durasi_beasiswa" class="form-control" placeholder="Durasi Beasiswa">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">File PKS</label>

                      <div class="col-sm-9">
                      <?php
                          echo form_dropdown('file_pks', array('File PKS', 'Ada'=>'Ada', 'Tidak Ada'=>'Tidak Ada', 'S3'=>'Doktor'), null, "class='form-control'");
                        ?>
                      </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-2 control-label">Lama Studi</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['lama_studi']; ?>" name="lama_studi" class="form-control" placeholder="Lama Studi">
                      </div>
                  </div>


                  <div class="form-group">
                  <label class="col-sm-2 control-label">Status Perkuliahan</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['status_perkuliahan']; ?>" name="status_perkuliahan" class="form-control" placeholder="Status Perkuliahan">
                      </div>
                  </div>


                  <div class="form-group">
                  <label class="col-sm-2 control-label">Status Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['status_beasiswa']; ?>" name="status_beasiswa" class="form-control" placeholder="Status Beasiswa">
                      </div>
                  </div>



                  <div class="form-group">
                  <label class="col-sm-2 control-label">Bank</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['bank']; ?>" name="bank" class="form-control" placeholder="Bank">
                      </div>
                  </div>


                  <div class="form-group">
                  <label class="col-sm-2 control-label">No Rekening</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $siswa['norek']; ?>" name="norek" class="form-control" placeholder="Nomor Rekening">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('siswa', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
                        ?>
                      </div>
                  </div>

                </div>
                <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>