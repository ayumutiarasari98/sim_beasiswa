<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Form Edit Program Studi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
                echo form_open('prodi/edit', 'role="form" class="form-horizontal"');
                echo form_hidden('kd_mapel', $prodi['kd_prodi']);
            ?>

                <div class="box-body">

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Kode Program Studi</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $prodi['kd_prodi']; ?>" readonly="true" name="kd_prodi" class="form-control" placeholder="Masukkan Kode Program Studi">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nama Program Studi</label>

                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $prodi['nama_prodi']; ?>" name="nama_prodi" class="form-control" placeholder="Masukkan Nama Program Studi">
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-2 control-label"></label>

                      <div class="col-sm-1">
                        <button type="submit" name="submit" class="btn btn-primary btn-flat">Simpan</button>
                      </div>

                      <div class="col-sm-1">
                        <?php
                          echo anchor('prodi', 'Kembali', array('class'=>'btn btn-danger btn-flat'));
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