<?php $__env->startSection('content'); ?>
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Detail Pemesanan Tiket</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td>Kode Pemesanan</td>
                                        <td><?php echo e($data->kode_pemesanan); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pemesanan</td>
                                        <td><?php echo e($data->tgl_pemesanan); ?></td>
                                    </tr>
                                    <?php if($data->id_jenis == 2): ?>
                                        <tr>
                                            <td>Batas Masuk</td>
                                            <td><?php echo e($nextDay); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($data->id_customer != 0): ?>
                                        <tr>
                                            <td>Nama Customer</td>
                                            <td><?php echo e($data->customer->nama); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if(!is_null($data->id_karyawan)): ?>
                                        <tr>
                                            <td>Nama Karyawan</td>
                                            <td><?php echo e($data->karyawan->karyawan->nama); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td>Jumlah Tiket</td>
                                        <td><?php echo e($data->jumlah_tiket); ?> Tiket</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td>Rp. <?php echo e(number_format($data->total_uang_masuk, 0, ".", ".")); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Penggunaan</td>
                                        <td id="status">
                                            <?php if($data->status_penggunaan == 1): ?>
                                                <span class="label label-info">Sudah diverifikasi</span>
                                            <?php else: ?>
                                                <span class="label label-danger">Belum diverifikasi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pemesanan</td>
                                        <td>
                                            <?php if($data->id_jenis == 1): ?>
                                                <span class="label label-success"><?php echo e($data->jenisPemesanan->nama_jenis); ?></span>
                                            <?php else: ?>
                                                <span class="label label-warning"><?php echo e($data->jenisPemesanan->nama_jenis); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="<?php echo e(URL('pemesanan')); ?>" class="btn btn-primary"><i
                                                    class="icon icon-backward"></i> Back</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        var appKey = '<?php echo e(env('PUSHER_APP_KEY')); ?>';
        var pusher = new Pusher(appKey, {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            if (data.status == 1) {
                $("#status").html('<span class="label label-info">Sudah diverifikasi</span>');
            } else {
                $("#status").html('<span class="label label-danger">Belum diverifikasi</span>');
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>