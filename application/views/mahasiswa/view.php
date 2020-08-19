<section class="content">
    <div class="row">
        <div class="col-xs-12">

          <div class="box box-primary">
            <div class="box-header  with-border">
              <h3 class="box-title">Data Mahasiswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <!-- button add -->
            <?php
                echo anchor('mahasiswa/add', '<button class="btn bg-navy btn-flat margin">Tambah Data</button>');
                echo anchor('mahasiswa/form', '<button class="btn btn-warning btn-flat margin">Import Data</button>');
            ?>

              <table id="mytable" class="table table-striped table-bordered table-hover table-full-width dataTable" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NRP</th>
                        <th>NAMA</th>
                        <th>JENJANG</th>
                        <th>PROGRAM STUDI</th>
                        <th>BIDANG KEAHLIAN</th>
                        <th>JENIS BEASISWA</th>
                        <th>ANGKATAN</th>
                        <th>PERIODE ANGKATAN</th>
                        <th>DURASI BEASISWA</th>
                        <th>FILE PKS</th>
                        <th>LAMA STUDI</th>
                        <th>STATUS PERKULIAHAN</th>
                        <th>STATUS BEASISWA</th>
                        <th>BANK</th>
                        <th>NO REKENING</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- punya lama -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.0/jquery.dataTables.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.js"></script> -->

<!-- baru tapi cdn -->
<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css"> -->

<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<script>
        $(document).ready(function() {
            var t = $('#mytable').DataTable( {
                "ajax": '<?php echo site_url('mahasiswa/data'); ?>',
                "order": [[ 2, 'asc' ]],
                "columns": [
                    {
                        "data": null,
                        "width": "50px",
                        "class": "text-center",
                        "orderable": false,
                    },
                    
                    {
                        "data": "nrp",
                        "width": "120px",
                        "class": "text-center"
                    },
                    { 
                        "data": "nama",
                    },

                    {
                        "data": "jenjang",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "program_studi",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "bidang_keahlian",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "nama_beasiswa",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "angkatan",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "periode_angkatan",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "lama_studi",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "status_perkuliahan",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "status_beasiswa",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "bank",
                        "width": "120px",
                        "class": "text-center"
                    },

                    {
                        "data": "norek",
                        "width": "120px",
                        "class": "text-center"
                    },
                    
                    { 
                        "data": "aksi",
                        "width": "80px",
                        "class": "text-center"
                    },
                ]
            } );
               
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        } );
</script>