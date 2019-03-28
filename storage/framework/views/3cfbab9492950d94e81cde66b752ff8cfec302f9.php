<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Receipt</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page  { size: 38mm 58mm}

        .perusahaan {
            font-size: 10px;
            font-family: Arial;
            margin-left: 23%;
            margin-top: 10px;
            font-weight: bold;
        }

        .alamat {
            font-size: 4px;
            text-align: center;
            margin-top: 2px;
        }

        .garis {
            border-top: 1px double black;
            margin-right: 8px;
            margin-left: 8px;
        }

        .garis1 {
            border-top: 1px double black;
            width: 128px;
        }

        .garis2 {
            width: 128px;
            border-top: 1px double black;
        }

        .body {
            margin-top: 5px;
            margin-left: 5%;
        }

        th ,td {
            font-size: 5px;
            text-align: center;
        }

        .uang p {
            font-size: 5px;
            text-align: right;
            margin-right: 10px;
        }

        .qr_code {
            margin-left: 23%;
        }

        .footer p {
            text-align: center;
            font-size: 5px;
            margin-left: -8px;
        }
    </style>
</head>
<body>

<div class="perusahaan"><?php echo e($decode[4]->nilai_konfig); ?></div>
<p class="alamat"><?php echo e($decode[0]->nilai_konfig); ?></p>
<span class="underline"></span>
</body>
<div class="garis"></div>

<div class="body">
    <table cellpadding="3">
        <tr>
            <th>Kode Pemesanan</th>
            <th>Tanggal</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
        <tr>
            <td><?php echo e($data->kode_pemesanan); ?></td>
            <td><?php echo e(date('d-m-y', strtotime($data->tgl_pemesanan))); ?></td>
            <td><?php echo e(number_format($decode[2]->nilai_konfig, 0, ".", ".")); ?></td>
            <td><?php echo e($data->jumlah_tiket); ?> Buah</td>
        </tr>
    </table>

    <div class="uang">
        <p>Bayar     : Rp. <?php echo e(number_format($data->uang_pembayaran, 0, ".", ".")); ?></p>
        <p>Total     : Rp. <?php echo e(number_format($jumlah, 0, ".", ".")); ?></p>
        <p>Kembalian : Rp. <?php echo e(number_format($kembalian, 0, ".", ".")); ?></p>
    </div>

    <div class="qr_code">
        <img src="<?php echo e(asset('storage/qr_code/' . $data->qr_code)); ?>" alt="QR Code" width="65px" height="65px">
    </div>

    <div class="garis1"></div>

    <div class="footer">
        <p>Terima kasih telah berkunjung ke kolam renang kami.</p>
        <p>Telepon : <?php echo e($decode[5]->nilai_konfig); ?> Email : <?php echo e($decode[1]->nilai_konfig); ?></p>
    </div>

    <div class="garis2"></div>
</div>
</html>
