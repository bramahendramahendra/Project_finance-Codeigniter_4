<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data <?=$judul?></h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#bayar_all-data">
                        <i class="fas fa-plus-circle"></i>
                        Bayar Semua
                    </button>
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
                            <th>Code</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Plan</th>
                            <th>Debit Ke</th>
                            <th>Tagihan Bulan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?> 
                        <?php foreach ($data as $key => $value) : ?>
                            <?php 
                            echo "<pre>";
                            var_dump($value);
                            echo "</pre>";
                            $dataPlan = $value['data_plan'][0];
                            echo "<pre>";
                            var_dump($dataPlan);
                            echo "</pre>";
                            ?>
                            <?php if($dataPlan['status_debit'] === 1):?>
                                <?php $index = (count($dataPlan['data_debit']) > 3 ? 3 : count($dataPlan['data_debit']));?>
                                <?php $data_debit = array_slice($dataPlan['data_debit'], -$index, $index); ?>
                                <?php
                                echo "<pre>";
                                var_dump($data_debit);
                                echo "</pre>";
                                ?>
                                <?php foreach ($data_debit as $key1 => $value1) : ?>
                                    <tr>
                                        <?php if ($key1 == 0): ?>
                                            <td rowspan="<?=$index?>"><?= $no++ ?></td>
                                            <td rowspan="<?=$index?>"><?= $value['code'] ?></td>
                                            <td rowspan="<?=$index?>"><?= $value['kategori'] ?></td>
                                            <td rowspan="<?=$index?>"><?= $value['nama_tagihan'] ?></td>
                                            <td rowspan="<?=$index?>"><?= $dataPlan['plan'] ?></td>
                                        <?php endif; ?>
                                        <td><?= $value1['debit_ke'] ?></td>
                                        <td><?= $value1['debit_month'] ?></td>
                                        <td><?= $value1['debit'] ?></td>
                                        <td><?= $value1['status_debit'] ?></td>
                                        <td><?= $value1['debit_date'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#bayar-data<?= $value['id_nama_tagihan'] ?>">
                                                <i class="fas fa-exchange-alt">
                                                </i>
                                                Bayar 
                                            </button>
                                            <button class="btn btn-primary btn-sm detail-debit" data-id="<?= $value['id_nama_tagihan'] ?>">
                                                <i class="fas fa-folder">
                                                </i>
                                                Detail Plan
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else:?>
                               <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['code'] ?></td>
                                    <td><?= $value['kategori'] ?></td>
                                    <td><?= $value['nama_tagihan'] ?></td>
                                    <td><?= $value['data_plan'][0]['plan'] ?></td>
                                    <td>1</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td> 
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#bayar_first-data<?= $value['id_nama_tagihan'] ?>">
                                            <i class="fas fa-exchange-alt">
                                            </i>
                                            Ganti Plan
                                        </button>
                                        <button class="btn btn-primary btn-sm detail-debit" data-id="<?= $value['id_nama_tagihan'] ?>">
                                            <i class="fas fa-folder">
                                            </i>
                                            Detail Plan
                                        </button>
                                    </td>
                                </tr>
                            <?php endif;?>
                            <?php echo "===============================================";?>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Kategori</th>
                            <th>Nama Tagihan</th>
                            <th>Plan</th>
                            <th>Debit Ke</th>
                            <th>Tagihan Bulan</th>
                            <th>Jumlah Tagihan</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Pembayaran</th>
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
<!-- Modal Bayar All Data -->  
<div class="modal fade" id="bayar_all-data">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bayar Semua Tagihan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('debit_tagihan/pay_all') ?>
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
                        <label for="cicilan_dengan_bunga">Cicilan dengan Bunga ( <?= isset($dataBungaTagihan['bunga']) ? $dataBungaTagihan['bunga'] : 0; ?>%)</label>
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

<script>
    $(function () {
        $("#table-datatables").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-datatables_wrapper .col-md-6:eq(0)');

        $('.select2').select2()
    });
</script>