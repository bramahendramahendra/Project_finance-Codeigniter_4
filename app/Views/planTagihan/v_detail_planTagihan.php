<?php 
echo "<pre>";
var_dump($data);
echo "</pre>";
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Detail <?=$judul?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <dt class="col-sm-2">Kategori</dt>
                    <dd class="col-sm-10"><?=$data['kategori']?></dd>
                    
                    <dt class="col-sm-2">Code</dt>
                    <dd class="col-sm-10"><?=$data['code']?></dd>
                    
                    <dt class="col-sm-2">Nama Tagihan</dt>
                    <dd class="col-sm-10"><?=$data['nama_tagihan']?></dd>
                    
                    <dt class="col-sm-2">Deskripsi</dt>
                    <dd class="col-sm-10"><?=$data['deskripsi']?></dd>
                    
                    <dt class="col-sm-2">Status</dt>
                    <dd class="col-sm-10"><?=$data['nama_status']?></dd>
                    
                    <dt class="col-sm-2">Jumlah Tagihan</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['jumlah_tagihan'])?></dd>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<?php if($data['status_plan'] === 1): ?>
    <?php foreach ($data['data_plan'] as $key => $dataPlan) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Plan <?=$dataPlan['plan']?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <dt class="col-sm-2">Jangka Waktu</dt>
                        <dd class="col-sm-10"><?=$dataPlan['jangka_waktu']?></dd>
                        
                        <dt class="col-sm-2">Cicilan</dt>
                        <dd class="col-sm-10"><?=format_rupiah($dataPlan['cicilan'])?></dd>
                        
                        <dt class="col-sm-2">Cicilan dengan Bunga</dt>
                        <dd class="col-sm-10"><?=format_rupiah($dataPlan['cicilan_dengan_bunga'])?></dd>
                        
                        <dt class="col-sm-2">Pembulatan Cicilan</dt>
                        <dd class="col-sm-10"><?=format_rupiah($dataPlan['pembulatan_cicilan'])?></dd>
                        
                        <dt class="col-sm-2">Total Tagihan</dt>
                        <dd class="col-sm-10"><?=format_rupiah($dataPlan['total_tagihan'])?></dd>
                        
                        <dt class="col-sm-2">Total Kelebihan Tagiham</dt>
                        <dd class="col-sm-10"><?=format_rupiah($dataPlan['total_kelebihan_tagihan'])?></dd>
                    </div>
                    <?php
                    // echo "<pre>";
                    // var_dump($dataPlan['data_debit']);
                    // echo "</pre>";
                    ?>
                    <table id="table-datatables-<?=$key?>" class="table table-bordered table-striped table-datatables">
                        <thead>
                            <tr>
                                <th width="5%">Bulan</th>
                                <th>Debit</th>
                                <th>Debit Tanpa Bunga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($dataPlan['data_debit'] as $key1 => $value) { ?>
                                <tr>
                                    <td><?= $value['debit_month'] ?></td>
                                    <td><?= $value['debit'] ?></td>
                                    <td><?= $value['debit_tanpa_bunga'] ?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Bulan</th>
                                <th>Debit</th>
                                <th>Debit Tanpa Bunga</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php endforeach; ?>
<?php endif; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Summary</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
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
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <dt class="col-sm-2">Jumlah Debit</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['jumlah_debit'])?></dd>
                    
                    <dt class="col-sm-2">Jumlah Debit tanpa Bunga</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['jumlah_debit_tanpa_bunga'])?></dd>
                    
                    <dt class="col-sm-2">Jumlah Kredit</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['jumlah_kredit'])?></dd>
                    
                    <dt class="col-sm-2">Sisa Tagihan</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['sisa_tagihan'])?></dd>
                    
                    <dt class="col-sm-2">Sisa Tagihan tanpa Bunga</dt>
                    <dd class="col-sm-10"><?=format_rupiah($data['sisa_tagihan_tanpa_bunga'])?></dd>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <button class="btn btn-danger btn-sm btn-back" >
                        <i class="fas fa-arrow-left">
                        </i>
                        Kembali
                    </button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-data<?= $data['id_nama_tagihan'] ?>">
                        <i class="fas fa-exchange-alt">
                        </i>
                        Ganti Plan
                    </button>
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-data<?= $data['id_nama_tagihan'] ?>">
                        <i class="fas fa-pencil-alt">
                        </i>
                        Edit Plan
                    </button>
                </div>
            </div>
        </div>        
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>

<!-- Modal  -->
<!-- Modal Add Data -->  
<div class="modal fade" id="add-data<?= $data['id_nama_tagihan'] ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('plan_tagihan/store') ?>
            <input type="hidden" name="id_nama_tagihan" value="<?= $data['id_nama_tagihan'] ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-3">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control code" id="code<?= $data['id_nama_tagihan'] ?>" value="<?= $data['code'] ?>" placeholder="Code" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" class="form-control kategori" id="kategori<?= $data['id_nama_tagihan'] ?> value="<?= $data['kategori'] ?>" placeholder="Kategori" readonly>
                    </div>
                    <div class="form-group col-5">
                        <label for="nama_tagihan">Nama Tagihan</label>
                        <input type="text" name="nama_tagihan" class="form-control nama_tagihan" id="nama_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $data['nama_tagihan'] ?>" placeholder="Nama Tagihan" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <?php $jumlahTagihan_value = isset($data['jumlah_tagihan']) ? format_rupiah($data['jumlah_tagihan']) : ''; ?>
                        <label for="jumlah_tagihan">Jumlah Tagihan</label>
                        <input type="text" name="jumlah_tagihan" class="form-control jumlah_tagihan" id="jumlah_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $jumlahTagihan_value ?>" placeholder="Jumlah Tagihan" readonly>
                    </div>
                    <div class="form-group col-4">
                        <?php $jumlahPembayaranTagihan_value = isset($data['jumlah_debit']) ? format_rupiah($data['jumlah_debit']) : format_rupiah(0); ?>
                        <label for="jumlah_pembayaran_tagihan">Jumlah Pembayaran Tagihan</label>
                        <input type="text" name="jumlah_pembayaran_tagihan" class="form-control jumlah_pembayaran_tagihan" id="jumlah_pembayaran_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $jumlahPembayaranTagihan_value ?>" placeholder="Jumlah Pembayaran Tagihan" readonly>
                    </div>
                    <div class="form-group col-4">
                        <?php $sisaJumlahTagihan_value = isset($data['sisa_tagihan']) && $data['sisa_tagihan'] ? format_rupiah($data['sisa_tagihan']) : format_rupiah($data['jumlah_tagihan']); ?>
                        <label for="sisa_jumlah_tagihan_tanpa_bunga">Sisa Jumlah Tagihan Tanpa Bunga</label>
                        <input type="text" name="sisa_jumlah_tagihan_tanpa_bunga" class="form-control sisa_jumlah_tagihan_tanpa_bunga" id="sisa_jumlah_tagihan_tanpa_bunga<?= $data['id_nama_tagihan'] ?>" value="<?= $sisaJumlahTagihan_value ?>" placeholder="Sisa Jumlah Tagihan Tanpa Bunga" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <?php  $plan_value = isset($data['status_plan']) && $data['status_plan'] === 1 ? count($data['data_plan'])+1 : 1; ?>
                        <label for="plan">Plan</label>
                        <input type="text" name="plan" class="form-control plan" id="plan<?= $data['id_nama_tagihan'] ?>" value="<?= $plan_value ?>"  placeholder="Plan" readonly>
                    </div>
                    <div class="form-group  col-8">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" name="jangka_waktu" class="form-control jangka_waktu" id="jangka_waktu<?= $data['id_nama_tagihan'] ?>" placeholder="Jangka Waktu" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  col-4">
                        <label for="cicilan">Cicilan</label>
                        <input type="text" name="cicilan" class="form-control cicilan" id="cicilan<?= $data['id_nama_tagihan'] ?>" placeholder="Cicilan" readonly>
                    </div>
                    <div class="form-group  col-4">
                        <label for="cicilan_dengan_bunga">Cicilan dengan Bunga</label>
                        <input type="text" name="cicilan_dengan_bunga" class="form-control cicilan_dengan_bunga" id="cicilan_dengan_bunga<?= $data['id_nama_tagihan'] ?>" placeholder="Cicilan dengan Bunga" readonly>
                    </div>
                    <div class="form-group  col-4">
                        <label for="pembulatan_cicilan">Pembulatan Cicilan</label>
                        <input type="text" name="pembulatan_cicilan" class="form-control pembulatan_cicilan" id="pembulatan_cicilan<?= $data['id_nama_tagihan'] ?>" placeholder="Pembulatan Cicilan" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  col-6">
                        <label for="total_tagihan">Total Tagihan</label>
                        <input type="text" name="total_tagihan" class="form-control total_tagihan" id="total_tagihan<?= $data['id_nama_tagihan'] ?>" placeholder="Total Tagihan" readonly>
                    </div>
                    <div class="form-group  col-6">
                        <label for="total_kelebihan_tagihan">Total Kelebihan Tagihan</label>
                        <input type="text" name="total_kelebihan_tagihan" class="form-control total_kelebihan_tagihan" id="total_kelebihan_tagihan<?= $data['id_nama_tagihan'] ?>" placeholder="Total Kelebihan Tagihan" readonly>
                    </div>
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
<div class="modal fade" id="edit-data<?= $data['id_nama_tagihan'] ?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('plan_tagihan/update/'.$data['id_nama_tagihan']) ?>
            <?php
            // echo "<pre>";
            // var_dump($data);    
            // echo "</pre>";    
            $lastDataPlan = end($data['data_plan']);
            echo "<pre>";
            var_dump($lastDataPlan);    
            echo "</pre>"; 
            // die;   
            
            ?>
            <input type="hidden" name="id_nama_tagihan" value="<?= $data['id_nama_tagihan'] ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-3">
                        <label for="code">Code</label>
                        <input type="text" name="code" class="form-control code" id="edit_code<?= $data['id_nama_tagihan'] ?>" value="<?= $data['code'] ?>" placeholder="Code" readonly>
                    </div>
                    <div class="form-group col-4">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" class="form-control kategori" id="edit_kategori<?= $data['id_nama_tagihan'] ?> value="<?= $data['kategori'] ?>" placeholder="Kategori" readonly>
                    </div>
                    <div class="form-group col-5">
                        <label for="nama_tagihan">Nama Tagihan</label>
                        <input type="text" name="nama_tagihan" class="form-control nama_tagihan" id="edit_nama_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $data['nama_tagihan'] ?>" placeholder="Nama Tagihan" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <?php $jumlahTagihan_value = isset($data['jumlah_tagihan']) ? format_rupiah($data['jumlah_tagihan']) : ''; ?>
                        <label for="jumlah_tagihan">Jumlah Tagihan</label>
                        <input type="text" name="jumlah_tagihan" class="form-control jumlah_tagihan" id="edit_jumlah_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $jumlahTagihan_value ?>" placeholder="Jumlah Tagihan" readonly>
                    </div>
                    <div class="form-group col-4">
                        <?php $jumlahPembayaranTagihan_value = isset($data['jumlah_debit']) ? format_rupiah($data['jumlah_debit']) : format_rupiah(0); ?>
                        <label for="jumlah_pembayaran_tagihan">Jumlah Pembayaran Tagihan</label>
                        <input type="text" name="jumlah_pembayaran_tagihan" class="form-control jumlah_pembayaran_tagihan" id="edit_jumlah_pembayaran_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $jumlahPembayaranTagihan_value ?>" placeholder="Jumlah Pembayaran Tagihan" readonly>
                    </div>
                    <div class="form-group col-4">
                        <?php $sisaJumlahTagihan_value = isset($data['sisa_tagihan']) && $data['sisa_tagihan'] ? format_rupiah($data['sisa_tagihan']) : format_rupiah($data['jumlah_tagihan']); ?>
                        <label for="sisa_jumlah_tagihan_tanpa_bunga">Sisa Jumlah Tagihan Tanpa Bunga</label>
                        <input type="text" name="sisa_jumlah_tagihan_tanpa_bunga" class="form-control sisa_jumlah_tagihan_tanpa_bunga" id="edit_sisa_jumlah_tagihan_tanpa_bunga<?= $data['id_nama_tagihan'] ?>" value="<?= $sisaJumlahTagihan_value ?>" placeholder="Sisa Jumlah Tagihan Tanpa Bunga" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <?php  $plan_value = isset($data['status_plan']) && $data['status_plan'] === 1 ? $lastDataPlan['plan'] : 1; ?>
                        <label for="plan">Plan</label>
                        <input type="text" name="plan" class="form-control plan" id="edit_plan<?= $data['id_nama_tagihan'] ?>" value="<?= $plan_value ?>"  placeholder="Plan" readonly>
                    </div>
                    <div class="form-group  col-8">
                        <label for="jangka_waktu">Jangka Waktu</label>
                        <input type="text" name="jangka_waktu" class="form-control jangka_waktu" id="edit_jangka_waktu<?= $data['id_nama_tagihan'] ?>" value="<?=isset($lastDataPlan['jangka_waktu'])?$lastDataPlan['jangka_waktu']:''?>" placeholder="Jangka Waktu" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  col-4">
                        <?php $cicilan_value = isset($lastDataPlan['cicilan']) ? format_rupiah($lastDataPlan['cicilan']) : format_rupiah(0); ?>
                        <label for="cicilan">Cicilan</label>
                        <input type="text" name="cicilan" class="form-control cicilan" id="edit_cicilan<?= $data['id_nama_tagihan'] ?>" value="<?= $cicilan_value ?>" placeholder="Cicilan" readonly>
                    </div>
                    <div class="form-group  col-4">
                        <?php $cicilanDenganBunga_value = isset($lastDataPlan['cicilan_dengan_bunga']) ? format_rupiah($lastDataPlan['cicilan_dengan_bunga']) : format_rupiah(0); ?>
                        <label for="cicilan_dengan_bunga">Cicilan dengan Bunga</label>
                        <input type="text" name="cicilan_dengan_bunga" class="form-control cicilan_dengan_bunga" id="edit_cicilan_dengan_bunga<?= $data['id_nama_tagihan'] ?>" value="<?= $cicilanDenganBunga_value ?>" placeholder="Cicilan dengan Bunga" readonly>
                    </div>
                    <div class="form-group  col-4">
                        <?php $pembulatanCicilan_value = isset($lastDataPlan['pembulatan_cicilan']) ? format_rupiah($lastDataPlan['pembulatan_cicilan']) : format_rupiah(0); ?>
                        <label for="pembulatan_cicilan">Pembulatan Cicilan</label>
                        <input type="text" name="pembulatan_cicilan" class="form-control pembulatan_cicilan" id="edit_pembulatan_cicilan<?= $data['id_nama_tagihan'] ?>" value="<?= $pembulatanCicilan_value ?>" placeholder="Pembulatan Cicilan" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group  col-6">
                        <?php $totalTagihan_value = isset($lastDataPlan['total_tagihan']) ? format_rupiah($lastDataPlan['total_tagihan']) : format_rupiah(0); ?>
                        <label for="total_tagihan">Total Tagihan</label>
                        <input type="text" name="total_tagihan" class="form-control total_tagihan" id="edit_total_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $totalTagihan_value ?>" placeholder="Total Tagihan" readonly>
                    </div>
                    <div class="form-group  col-6">
                        <?php $totalKelebihanTagihan_value = isset($lastDataPlan['total_kelebihan_tagihan']) ? format_rupiah($lastDataPlan['total_kelebihan_tagihan']) : format_rupiah(0); ?>
                        <label for="total_kelebihan_tagihan">Total Kelebihan Tagihan</label>
                        <input type="text" name="total_kelebihan_tagihan" class="form-control total_kelebihan_tagihan" id="edit_total_kelebihan_tagihan<?= $data['id_nama_tagihan'] ?>" value="<?= $totalKelebihanTagihan_value   ?>" placeholder="Total Kelebihan Tagihan" readonly>
                    </div>
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

<script>
    $(document).ready(function() {
        const bungaTagihanValue = <?= isset($dataBungaTagihan['bunga']) ? $dataBungaTagihan['bunga'] : 0; ?>;

        $(function () {
            <?php if($data['status_plan'] === 1): ?>
                <?php foreach ($data['data_plan'] as $key => $dataPlan) : ?>
                    $("#table-datatables-<?=$key?>").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#table-datatables-<?=$key?>_wrapper .col-md-6:eq(0)');
                <?php endforeach; ?>
            <?php endif; ?>
        });

        $('.cicilan').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });

        $('.cicilan_dengan_bunga').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });
        
        $('.pembulatan_cicilan').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });

        $('.total_tagihan').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });

        $('.total_kelebihan_tagihan').on('keyup', function(e) {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        });

        $('[id^=jangka_waktu]').on('keyup', function() {
            var id = $(this).attr('id').replace('jangka_waktu', '');
            var sisaJumlahTagihanStr = $('#sisa_jumlah_tagihan_tanpa_bunga' + id).val();
            var jangkaWaktu = $(this).val() ? parseInt($(this).val()) : 1;
     
            if (jangkaWaktu < 1) {
                jangkaWaktu = 1;
                $(this).val(jangkaWaktu);
            }
     
            if (sisaJumlahTagihanStr) {
                var sisaJumlahTagihan = parseFloat(sisaJumlahTagihanStr.replace(/[^0-9]/g, ''));
                var jangkaWaktu = parseInt($(this).val());
                if (!isNaN(sisaJumlahTagihan) && !isNaN(jangkaWaktu) && jangkaWaktu > 0) {
                    var cicilan = sisaJumlahTagihan / jangkaWaktu;
                    cicilan = Math.round(cicilan);

                    var cicilanDenganBunga = bungaTagihanValue > 0 ? cicilan * (1 + (bungaTagihanValue / 100)) : cicilan;
                    cicilanDenganBunga = Math.round(cicilanDenganBunga);

                    $('#cicilan' + id).val(formatRupiah(cicilan.toString(), 'Rp '));
                    $('#cicilan_dengan_bunga' + id).val(formatRupiah(cicilanDenganBunga.toString(), 'Rp '));

                    $('#pembulatan_cicilan' + id).trigger('keyup');
                } else {
                    $('#cicilan' + id).val(formatRupiah('0', 'Rp '));
                    $('#cicilan_dengan_bunga' + id).val(formatRupiah('0', 'Rp '));
                }
            }
        });

        $('[id^=pembulatan_cicilan]').on('keyup', function() {
            var id = $(this).attr('id').replace('pembulatan_cicilan', '');
            var pembulatanCicilanStr = $(this).val();
            if (pembulatanCicilanStr) {
                var pembulatanCicilan = parseFloat(pembulatanCicilanStr.replace(/[^0-9]/g, ''));
                var jangkaWaktu = parseInt($('#jangka_waktu' + id).val());

                if (!isNaN(pembulatanCicilan) && !isNaN(jangkaWaktu) && jangkaWaktu > 0) {
                    var totalTagihan = pembulatanCicilan * jangkaWaktu;
                    var sisaJumlahTagihanStr = $('#sisa_jumlah_tagihan_tanpa_bunga' + id).val();
                    if (sisaJumlahTagihanStr) {
                        var sisaJumlahTagihan = parseFloat(sisaJumlahTagihanStr.replace(/[^0-9]/g, ''));
                        var totalKelebihanTagihan = totalTagihan - sisaJumlahTagihan;

                        $('#total_tagihan' + id).val(formatRupiah(totalTagihan.toString(), 'Rp '));
                        $('#total_kelebihan_tagihan' + id).val(formatRupiah(totalKelebihanTagihan.toString(), 'Rp '));
                    }
                } else {
                    $('#total_tagihan' + id).val(formatRupiah('0', 'Rp '));
                    $('#total_kelebihan_tagihan' + id).val(formatRupiah('0', 'Rp '));
                }
            } else {
                $('#total_tagihan' + id).val(formatRupiah('0', 'Rp '));
                $('#total_kelebihan_tagihan' + id).val(formatRupiah('0', 'Rp '));
            }
        });

        $('[id^=edit_jangka_waktu]').on('keyup', function() {
            var id = $(this).attr('id').replace('edit_jangka_waktu', '');
            var sisaJumlahTagihanStr = $('#edit_sisa_jumlah_tagihan_tanpa_bunga' + id).val();
            var jangkaWaktu = $(this).val() ? parseInt($(this).val()) : 1;
     
            if (jangkaWaktu < 1) {
                jangkaWaktu = 1;
                $(this).val(jangkaWaktu);
            }

            if (sisaJumlahTagihanStr) {
                var sisaJumlahTagihan = parseFloat(sisaJumlahTagihanStr.replace(/[^0-9]/g, ''));
                var jangkaWaktu = parseInt($(this).val());
                if (!isNaN(sisaJumlahTagihan) && !isNaN(jangkaWaktu) && jangkaWaktu > 0) {
                    var cicilan = sisaJumlahTagihan / jangkaWaktu;
                    cicilan = Math.round(cicilan);

                    var cicilanDenganBunga = bungaTagihanValue > 0 ? cicilan * (1 + (bungaTagihanValue / 100)) : cicilan;
                    cicilanDenganBunga = Math.round(cicilanDenganBunga);

                    $('#edit_cicilan' + id).val(formatRupiah(cicilan.toString(), 'Rp '));
                    $('#edit_cicilan_dengan_bunga' + id).val(formatRupiah(cicilanDenganBunga.toString(), 'Rp '));

                    $('#edit_pembulatan_cicilan' + id).trigger('keyup');
                } else {
                    $('#edit_cicilan' + id).val(formatRupiah('0', 'Rp '));
                    $('#edit_cicilan_dengan_bunga' + id).val(formatRupiah('0', 'Rp '));
                }
            }
        });

        $('[id^=edit_pembulatan_cicilan]').on('keyup', function() {
            var id = $(this).attr('id').replace('edit_pembulatan_cicilan', '');
            var pembulatanCicilanStr = $(this).val();
            if (pembulatanCicilanStr) {
                var pembulatanCicilan = parseFloat(pembulatanCicilanStr.replace(/[^0-9]/g, ''));
                var jangkaWaktu = parseInt($('#edit_jangka_waktu' + id).val());

                if (!isNaN(pembulatanCicilan) && !isNaN(jangkaWaktu) && jangkaWaktu > 0) {
                    var totalTagihan = pembulatanCicilan * jangkaWaktu;
                    var sisaJumlahTagihanStr = $('#edit_sisa_jumlah_tagihan_tanpa_bunga' + id).val();
                    if (sisaJumlahTagihanStr) {
                        var sisaJumlahTagihan = parseFloat(sisaJumlahTagihanStr.replace(/[^0-9]/g, ''));
                        var totalKelebihanTagihan = totalTagihan - sisaJumlahTagihan;

                        $('#edit_total_tagihan' + id).val(formatRupiah(totalTagihan.toString(), 'Rp '));
                        $('#edit_total_kelebihan_tagihan' + id).val(formatRupiah(totalKelebihanTagihan.toString(), 'Rp '));
                    }
                } else {
                    $('#edit_total_tagihan' + id).val(formatRupiah('0', 'Rp '));
                    $('#edit_total_kelebihan_tagihan' + id).val(formatRupiah('0', 'Rp '));
                }
            } else {
                $('#edit_total_tagihan' + id).val(formatRupiah('0', 'Rp '));
                $('#edit_total_kelebihan_tagihan' + id).val(formatRupiah('0', 'Rp '));
            }
        });

        $('.btn-back').on('click', function() {
            window.location.href = '<?= base_url('plan_tagihan') ?>';
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