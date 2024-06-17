<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data <?=$judul?></h5>
                <div class="card-tools">
                    <?php if(count($data) < 1): ?>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-data">
                            <i class="fas fa-plus-circle"></i>
                            Tambah <?=$judul?>
                        </button>
                    <?php endif; ?>
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
                            <th>Limit Pembayaran Tagihan</th>
                            <th>Sisa Limit Tagihan</th>
                            <th>Limit Digunakan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1; 
                        foreach ($data as $key => $value) { ?>
                            <tr>
                                <td>1</td>
                                <td><?= format_rupiah($value['limit_bayar_tagihan']) ?></td>
                                <td><?= format_rupiah($value['sisa_limit_tagihan']) ?></td>
                                <td><?= format_rupiah($value['limit_digunakan']) ?></td>
                                <td> 
                                    <button class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#edit-data<?= $value['id'] ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Limit Pembayaran Tagihan</th>
                            <th>Sisa Limit Tagihan</th>
                            <th>Limit Digunakan</th>
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
<div class="modal fade" id="add-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('limit_tagihan/store') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="limit_bayar_tagihan">Limit Pembayaran Tagihan</label>
                    <input type="text" name="limit_bayar_tagihan" class="form-control limit_bayar_tagihan" placeholder="Limit Pembayaran Tagihan" required>
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


<!-- Modal Edit Data -->  
<?php foreach ($data as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('limit_tagihan/update/'.$value['id']) ?>
                <div class="modal-body">
                    <input type="hidden" name="sisa_limit_tagihan" value="<?= $value['sisa_limit_tagihan'] ?>">
                    <input type="hidden" name="limit_digunakan" value="<?= $value['limit_digunakan'] ?>">
                    <div class="form-group">
                        <?php $limitBayarTagihan_value = isset($value['limit_bayar_tagihan']) ? format_rupiah($value['limit_bayar_tagihan']) : ''; ?>
                        <label for="limit_bayar_tagihan">Limit Pembayaran Tagihan</label>
                        <input type="text" name="limit_bayar_tagihan" value="<?= $limitBayarTagihan_value ?>" class="form-control limit_bayar_tagihan" placeholder="Limit Pembayaran Tagihan" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning btn-flat">Save</button>
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
    $(document).ready(function() {

        $(function () {
            $("#table-datatables").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#table-datatables_wrapper .col-md-6:eq(0)');

            $('.select2').select2()
        });

        $('.limit_bayar_tagihan').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });
    });
    
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
</script>