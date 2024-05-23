<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data <?=$judul?></h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <a href="#" class="dropdown-item">Something else here</a>
                            <a class="dropdown-divider"></a>
                            <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php 
                if(session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i>';
                    echo session()->getFlashdata('success');
                    echo '</h5></div>';
                } elseif(session()->getFlashdata('error'))  {
                    echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i>';
                    echo session()->getFlashdata('error');
                    echo '</h5></div>';
                }
                ?>
                <table id="table-datatables" class="table table-bordered table-striped table-datatables">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Plan</th>
                            <th>Jangka Waktu</th>
                            <th>Cicilan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1; 
                        foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['kategori'] ?></td>
                                <td><?= $value['nama_tagihan'] ?></td>
                                <td><?= format_rupiah($value['jumlah_tagihan']) ?></td>
                                <td>-</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" >
                                        <i class="fas fa-folder">
                                        </i>
                                        Detail Plan
                                    </button>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-data<?= $value['id'] ?>">
                                        <i class="fas fa-plus-circle">
                                        </i>
                                        Tambah Plan
                                    </button>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id'] ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit Plan
                                    </button>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#delete-data<?= $value['id'] ?>">
                                        <i class="fas fa-exchange-alt">
                                        </i>
                                        Ganti Plan
                                    </button>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Plan</th>
                            <th>Jangka Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                    <div class="description-block">
                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


<!-- Modal  -->
<!-- Modal Add Data -->  
<?php foreach ($data as $key => $value) { ?>
    <div class="modal fade" id="add-data<?= $value['id'] ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('nama_tagihan/store') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?= $value['kategori'] ?>" placeholder="Kategori" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_tagihan">Nama Tagihan</label>
                        <input type="text" name="nama_tagihan" class="form-control" value="<?= $value['nama_tagihan'] ?>" placeholder="Nama Tagihan" readonly>
                    </div>
                    <?php  $formatted_value = isset($value['jumlah_tagihan']) ? format_rupiah($value['jumlah_tagihan']) : ''; ?>
                    <div class="form-group">
                        <label for="jumlah_tagihan">Jumlah Tagihan</label>
                        <input type="text" name="jumlah_tagihan" class="form-control jumlah_tagihan" value="<?= $formatted_value ?>" placeholder="Jumlah Tagihan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_tagihan">Sisa Jumlah Tagihan</label>
                        <input type="text" name="sisa_jumlah_tagihan" class="form-control jumlah_tagihan" value="<?= $formatted_value ?>" placeholder="Sisa Jumlah Tagihan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="plan">Plan</label>
                        <input type="text" name="plan" class="form-control"  placeholder="Plan" required>
                    </div>
                    <div class="form-group">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" name="plan" class="form-control" placeholder="Jangka Waktu" required>
                    </div>
                    <div class="form-group">
                        <label for="cicilan">Cicilan</label>
                        <input type="text" name="plan" class="form-control" placeholder="Cicilan" required>
                    </div>
                    <div class="form-group">
                        <label for="cicilan_dengan_bunga">Cicilan dengan Bunga</label>
                        <input type="text" name="plan" class="form-control" placeholder="Cicilan dengan Bunga" required>
                    </div>
                    <div class="form-group">
                        <label for="pembulatan_cicilan">Pembulatan Cicilan</label>
                        <input type="text" name="plan" class="form-control" placeholder="Pembulatan Cicilan" required>
                    </div>
                    <div class="form-group">
                        <label for="total_tagihan">Total Tagihan</label>
                        <input type="text" name="plan" class="form-control" placeholder="Total Tagihan" required>
                    </div>
                    <div class="form-group">
                        <label for="total_kelebihan_tagihan">Total kelebihan tagihan</label>
                        <input type="text" name="plan" class="form-control" placeholder="Total lebih tagihan" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    $(function () {
        $("#table-datatables").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-datatables_wrapper .col-md-6:eq(0)');

        $('.select2').select2()
    });
</script>