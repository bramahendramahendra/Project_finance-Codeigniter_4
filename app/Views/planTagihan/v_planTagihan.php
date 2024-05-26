<?php 
// echo "<pre>";
// var_dump($data[3]);
// echo "</pre>";
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data <?=$judul?></h5>
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
                            <th>Code</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Plan</th>
                            <th>Jangka Waktu</th>
                            <th>Cicilan per Bulan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($data as $key => $value): ?>
                            <?php if($value['status_plan'] === 1):?>
                                <?php  $rowspan = count($value['data_plan']); ?>
                                <?php foreach ($value['data_plan'] as $index => $plan): ?>
                                    <tr>
                                        <?php if ($index == 0): ?>
                                            <td rowspan="<?= $rowspan ?>"><?= $no++ ?></td>
                                            <td rowspan="<?= $rowspan ?>"><?= $value['code'] ?></td>
                                            <td rowspan="<?= $rowspan ?>"><?= $value['kategori'] ?></td>
                                            <td rowspan="<?= $rowspan ?>"><?= $value['nama_tagihan'] ?></td>
                                            <td rowspan="<?= $rowspan ?>"><?= format_rupiah($value['jumlah_tagihan']) ?></td>
                                        <?php endif; ?>
                                        <td><?= $plan['plan'] ?></td>
                                        <td><?= $plan['jangka_waktu'] ?> Bulan</td>
                                        <td><?= format_rupiah($plan['pembulatan_cicilan']) ?></td>
                                        <?php if ($index == 0): ?>
                                            <td rowspan="<?= $rowspan ?>">
                                                <button class="btn btn-primary btn-sm detail-plan" data-id="<?= $value['id_nama_tagihan'] ?>">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                    Detail Plan
                                                </button>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#add-data<?= $value['id_nama_tagihan'] ?>">
                                                    <i class="fas fa-exchange-alt">
                                                    </i>
                                                    Ganti Plan
                                                </button>
                                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit-data<?= $value['id_nama_tagihan'] ?>">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                    Edit Plan
                                                </button>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else:?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['code'] ?></td>
                                    <td><?= $value['kategori'] ?></td>
                                    <td><?= $value['nama_tagihan'] ?></td>
                                    <td><?= format_rupiah($value['jumlah_tagihan']) ?></td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>
                                        <!-- <button class="btn btn-primary btn-sm" >
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail Plan
                                        </button> -->
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-data<?= $value['id_nama_tagihan'] ?>">
                                            <i class="fas fa-plus-circle">
                                            </i>
                                            Tambah Plan
                                        </button>
                                    </td>
                                </tr>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Plan</th>
                            <th>Jangka Waktu</th>
                            <th>Cicilan</th>
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
    <div class="modal fade" id="add-data<?= $value['id_nama_tagihan'] ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Data <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('plan_tagihan/store') ?>
                <input type="hidden" name="id_nama_tagihan" value="<?= $value['id_nama_tagihan'] ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control code" id="code<?= $value['id_nama_tagihan'] ?>" value="<?= $value['code'] ?>" placeholder="Code" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="kategori" class="form-control kategori" id="kategori<?= $value['id_nama_tagihan'] ?> value="<?= $value['kategori'] ?>" placeholder="Kategori" readonly>
                        </div>
                        <div class="form-group col-5">
                            <label for="nama_tagihan">Nama Tagihan</label>
                            <input type="text" name="nama_tagihan" class="form-control nama_tagihan" id="nama_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $value['nama_tagihan'] ?>" placeholder="Nama Tagihan" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <?php $jumlahTagihan_value = isset($value['jumlah_tagihan']) ? format_rupiah($value['jumlah_tagihan']) : ''; ?>
                            <label for="jumlah_tagihan">Jumlah Tagihan</label>
                            <input type="text" name="jumlah_tagihan" class="form-control jumlah_tagihan" id="jumlah_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $jumlahTagihan_value ?>" placeholder="Jumlah Tagihan" readonly>
                        </div>
                        <div class="form-group col-4">
                            <?php $jumlahPembayaranTagihan_value = isset($value['jumlah_debit']) ? format_rupiah($value['jumlah_debit']) : format_rupiah(0); ?>
                            <label for="jumlah_pembayaran_tagihan">Jumlah Pembayaran Tagihan</label>
                            <input type="text" name="jumlah_pembayaran_tagihan" class="form-control jumlah_pembayaran_tagihan" id="jumlah_pembayaran_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $jumlahPembayaranTagihan_value ?>" placeholder="Jumlah Pembayaran Tagihan" readonly>
                        </div>
                        <div class="form-group col-4">
                            <?php $sisaJumlahTagihan_value = isset($value['sisa_tagihan']) && $value['sisa_tagihan'] ? format_rupiah($value['sisa_tagihan']) : format_rupiah($value['jumlah_tagihan']); ?>
                            <label for="sisa_jumlah_tagihan_tanpa_bunga">Sisa Jumlah Tagihan Tanpa Bunga</label>
                            <input type="text" name="sisa_jumlah_tagihan_tanpa_bunga" class="form-control sisa_jumlah_tagihan_tanpa_bunga" id="sisa_jumlah_tagihan_tanpa_bunga<?= $value['id_nama_tagihan'] ?>" value="<?= $sisaJumlahTagihan_value ?>" placeholder="Sisa Jumlah Tagihan Tanpa Bunga" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <?php  $plan_value = isset($value['status_plan']) && $value['status_plan'] === 1 ? count($value['data_plan'])+1 : 1; ?>
                            <label for="plan">Plan</label>
                            <input type="text" name="plan" class="form-control plan" id="plan<?= $value['id_nama_tagihan'] ?>" value="<?= $plan_value ?>"  placeholder="Plan" readonly>
                        </div>
                        <div class="form-group  col-8">
                            <label for="jangka_waktu">Jangka Waktu</label>
                            <input type="text" name="jangka_waktu" class="form-control jangka_waktu" id="jangka_waktu<?= $value['id_nama_tagihan'] ?>" placeholder="Jangka Waktu" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-4">
                            <label for="cicilan">Cicilan</label>
                            <input type="text" name="cicilan" class="form-control cicilan" id="cicilan<?= $value['id_nama_tagihan'] ?>" placeholder="Cicilan" readonly>
                        </div>
                        <div class="form-group  col-4">
                            <label for="cicilan_dengan_bunga">Cicilan dengan Bunga</label>
                            <input type="text" name="cicilan_dengan_bunga" class="form-control cicilan_dengan_bunga" id="cicilan_dengan_bunga<?= $value['id_nama_tagihan'] ?>" placeholder="Cicilan dengan Bunga" readonly>
                        </div>
                        <div class="form-group  col-4">
                            <label for="pembulatan_cicilan">Pembulatan Cicilan</label>
                            <input type="text" name="pembulatan_cicilan" class="form-control pembulatan_cicilan" id="pembulatan_cicilan<?= $value['id_nama_tagihan'] ?>" placeholder="Pembulatan Cicilan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-6">
                            <label for="total_tagihan">Total Tagihan</label>
                            <input type="text" name="total_tagihan" class="form-control total_tagihan" id="total_tagihan<?= $value['id_nama_tagihan'] ?>" placeholder="Total Tagihan" readonly>
                        </div>
                        <div class="form-group  col-6">
                            <label for="total_kelebihan_tagihan">Total Kelebihan Tagihan</label>
                            <input type="text" name="total_kelebihan_tagihan" class="form-control total_kelebihan_tagihan" id="total_kelebihan_tagihan<?= $value['id_nama_tagihan'] ?>" placeholder="Total Kelebihan Tagihan" readonly>
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
<?php } ?>

<!-- Modal Edit Data -->  
<?php foreach ($data as $key => $value) { ?>
    <div class="modal fade" id="edit-data<?= $value['id_nama_tagihan'] ?>">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php echo form_open('plan_tagihan/update/'.$value['id_nama_tagihan']) ?>
                <?php
                // echo "<pre>";
                // var_dump($value);    
                // echo "</pre>";    
                $lastDataPlan = end($value['data_plan']);
                echo "<pre>";
                var_dump($lastDataPlan);    
                echo "</pre>"; 
                // die;   
                
                ?>
                <input type="hidden" name="id_nama_tagihan" value="<?= $value['id_nama_tagihan'] ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" class="form-control code" id="edit_code<?= $value['id_nama_tagihan'] ?>" value="<?= $value['code'] ?>" placeholder="Code" readonly>
                        </div>
                        <div class="form-group col-4">
                            <label for="kategori">Kategori</label>
                            <input type="text" name="kategori" class="form-control kategori" id="edit_kategori<?= $value['id_nama_tagihan'] ?> value="<?= $value['kategori'] ?>" placeholder="Kategori" readonly>
                        </div>
                        <div class="form-group col-5">
                            <label for="nama_tagihan">Nama Tagihan</label>
                            <input type="text" name="nama_tagihan" class="form-control nama_tagihan" id="edit_nama_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $value['nama_tagihan'] ?>" placeholder="Nama Tagihan" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <?php $jumlahTagihan_value = isset($value['jumlah_tagihan']) ? format_rupiah($value['jumlah_tagihan']) : ''; ?>
                            <label for="jumlah_tagihan">Jumlah Tagihan</label>
                            <input type="text" name="jumlah_tagihan" class="form-control jumlah_tagihan" id="edit_jumlah_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $jumlahTagihan_value ?>" placeholder="Jumlah Tagihan" readonly>
                        </div>
                        <div class="form-group col-4">
                            <?php $jumlahPembayaranTagihan_value = isset($value['jumlah_debit']) ? format_rupiah($value['jumlah_debit']) : format_rupiah(0); ?>
                            <label for="jumlah_pembayaran_tagihan">Jumlah Pembayaran Tagihan</label>
                            <input type="text" name="jumlah_pembayaran_tagihan" class="form-control jumlah_pembayaran_tagihan" id="edit_jumlah_pembayaran_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $jumlahPembayaranTagihan_value ?>" placeholder="Jumlah Pembayaran Tagihan" readonly>
                        </div>
                        <div class="form-group col-4">
                            <?php $sisaJumlahTagihan_value = isset($value['sisa_tagihan']) && $value['sisa_tagihan'] ? format_rupiah($value['sisa_tagihan']) : format_rupiah($value['jumlah_tagihan']); ?>
                            <label for="sisa_jumlah_tagihan_tanpa_bunga">Sisa Jumlah Tagihan Tanpa Bunga</label>
                            <input type="text" name="sisa_jumlah_tagihan_tanpa_bunga" class="form-control sisa_jumlah_tagihan_tanpa_bunga" id="edit_sisa_jumlah_tagihan_tanpa_bunga<?= $value['id_nama_tagihan'] ?>" value="<?= $sisaJumlahTagihan_value ?>" placeholder="Sisa Jumlah Tagihan Tanpa Bunga" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <?php  $plan_value = isset($value['status_plan']) && $value['status_plan'] === 1 ? $lastDataPlan['plan'] : 1; ?>
                            <label for="plan">Plan</label>
                            <input type="text" name="plan" class="form-control plan" id="edit_plan<?= $value['id_nama_tagihan'] ?>" value="<?= $plan_value ?>"  placeholder="Plan" readonly>
                        </div>
                        <div class="form-group  col-8">
                            <label for="jangka_waktu">Jangka Waktu</label>
                            <input type="text" name="jangka_waktu" class="form-control jangka_waktu" id="edit_jangka_waktu<?= $value['id_nama_tagihan'] ?>" value="<?=isset($lastDataPlan['jangka_waktu'])?$lastDataPlan['jangka_waktu']:''?>" placeholder="Jangka Waktu" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-4">
                            <?php $cicilan_value = isset($lastDataPlan['cicilan']) ? format_rupiah($lastDataPlan['cicilan']) : format_rupiah(0); ?>
                            <label for="cicilan">Cicilan</label>
                            <input type="text" name="cicilan" class="form-control cicilan" id="edit_cicilan<?= $value['id_nama_tagihan'] ?>" value="<?= $cicilan_value ?>" placeholder="Cicilan" readonly>
                        </div>
                        <div class="form-group  col-4">
                            <?php $cicilanDenganBunga_value = isset($lastDataPlan['cicilan_dengan_bunga']) ? format_rupiah($lastDataPlan['cicilan_dengan_bunga']) : format_rupiah(0); ?>
                            <label for="cicilan_dengan_bunga">Cicilan dengan Bunga</label>
                            <input type="text" name="cicilan_dengan_bunga" class="form-control cicilan_dengan_bunga" id="edit_cicilan_dengan_bunga<?= $value['id_nama_tagihan'] ?>" value="<?= $cicilanDenganBunga_value ?>" placeholder="Cicilan dengan Bunga" readonly>
                        </div>
                        <div class="form-group  col-4">
                            <?php $pembulatanCicilan_value = isset($lastDataPlan['pembulatan_cicilan']) ? format_rupiah($lastDataPlan['pembulatan_cicilan']) : format_rupiah(0); ?>
                            <label for="pembulatan_cicilan">Pembulatan Cicilan</label>
                            <input type="text" name="pembulatan_cicilan" class="form-control pembulatan_cicilan" id="edit_pembulatan_cicilan<?= $value['id_nama_tagihan'] ?>" value="<?= $pembulatanCicilan_value ?>" placeholder="Pembulatan Cicilan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group  col-6">
                            <?php $totalTagihan_value = isset($lastDataPlan['total_tagihan']) ? format_rupiah($lastDataPlan['total_tagihan']) : format_rupiah(0); ?>
                            <label for="total_tagihan">Total Tagihan</label>
                            <input type="text" name="total_tagihan" class="form-control total_tagihan" id="edit_total_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $totalTagihan_value ?>" placeholder="Total Tagihan" readonly>
                        </div>
                        <div class="form-group  col-6">
                            <?php $totalKelebihanTagihan_value = isset($lastDataPlan['total_kelebihan_tagihan']) ? format_rupiah($lastDataPlan['total_kelebihan_tagihan']) : format_rupiah(0); ?>
                            <label for="total_kelebihan_tagihan">Total Kelebihan Tagihan</label>
                            <input type="text" name="total_kelebihan_tagihan" class="form-control total_kelebihan_tagihan" id="edit_total_kelebihan_tagihan<?= $value['id_nama_tagihan'] ?>" value="<?= $totalKelebihanTagihan_value   ?>" placeholder="Total Kelebihan Tagihan" readonly>
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
<?php } ?>

<script>
    $(document).ready(function() {
        const bungaTagihanValue = <?= isset($dataBungaTagihan['bunga']) ? $dataBungaTagihan['bunga'] : 0; ?>;
    
        $(function () {
            $("#table-datatables").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#table-datatables_wrapper .col-md-6:eq(0)');

            // $('.select2').select2()
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

        $('.detail-plan').on('click', function() {
            var id = $(this).data('id');
            var form = $('<form action="<?= base_url('plan_tagihan/detail') ?>" method="post">' +
                '<input type="hidden" name="id" value="' + id + '"></input>' + '</form>');
            $('body').append(form);
            form.submit();
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