<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Beasiswa</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('beasiswa/edit', 'role="form" class="form-horizontal"');
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kode Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $beasiswa['kd_beasiswa']; ?>" name="kd_beasiswa" readonly="true" class="form-control" placeholder="Masukkan Kode Beasiswa">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $beasiswa['nama_beasiswa']; ?>" name="nama_beasiswa" class="form-control" placeholder="Masukkan Nama Beasiswa">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Pemberi Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" name="pemberi_beasiswa" class="form-control" placeholder="Masukkan Pemberi Beasiswa">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Detail Beasiswa</label>

                      <div class="col-sm-9">
                        <input type="text" name="detail_beasiswa" class="form-control" placeholder="Detail Beasiswa">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('beasiswa', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
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