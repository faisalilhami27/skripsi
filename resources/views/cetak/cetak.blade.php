<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Receipt</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
    .perusahaan {
      font-size: 15px;
      font-family: Arial;
      text-align: center;
      font-weight: bold;
      margin-left: -12px;
      margin-right: 12px;
    }

    .alamat {
      font-size: 9px;
      text-align: center;
      margin-top: 2px;
      margin-left: -5px;
      margin-right: 12px;
    }

    .garis {
      border-top: 1px double black;
      margin-right: -15px;
      margin-left: -15px;
    }

    .garis1 {
      border-top: 1px double black;
      margin-right: -15px;
      margin-left: -15px;
    }

    .garis2 {
      border-top: 1px double black;
      margin-right: -15px;
      margin-left: -15px;
    }

    .body {
      margin-top: 5px;
    }

    th, td {
      font-size: 12px;
      text-align: center;
    }

    .uang p {
      font-size: 12px;
      margin-right: 10px;
    }

    .qr_code {
      margin-left: -12px;
      margin-right: 12px;
    }

    .footer p {
      text-align: center;
      font-size: 11px;
      margin-left: -12px;
      margin-right: 12px;
    }
  </style>
</head>
<body>
<div class="perusahaan">{{ $decode[4]->nilai_konfig }}</div>
<p class="alamat">{{ $decode[0]->nilai_konfig }}</p>
<span class="underline"></span>
<div class="garis"></div>

<div class="body">
  <table cellpadding="1">
    <tr>
      <th>Kode</th>
      <th>Harga</th>
      <th>Jumlah</th>
    </tr>
    <tr>
      <td>{{ $data->kode_pemesanan }}</td>
      <td>{{ number_format($decode[2]->nilai_konfig, 0, ".", ".") }}</td>
      <td>{{ $data->jumlah_tiket }}</td>
    </tr>
  </table>

  <div class="uang">
    <p>Bayar : Rp. {{ number_format($data->uang_pembayaran, 0, ".", ".") }}</p>
    <p>Total : Rp. {{ number_format($jumlah, 0, ".", ".") }}</p>
    <p>Kembalian : Rp. {{ number_format($kembalian, 0, ".", ".") }}</p>
  </div>

  <div class="qr_code" align="center">
    <img src="{{ asset('storage/qr_code/' . $data->qr_code) }}" alt="QR Code" width="150px" height="150px">
  </div>

  <div class="garis1"></div>

  <div class="footer">
    <p>Terima kasih telah berkunjung.</p>
    <p>Telepon : {{ $decode[5]->nilai_konfig }}</p>
    <p>Email : {{ $decode[1]->nilai_konfig }}</p>
  </div>

  <div class="garis2"></div>
</div>
</body>
</html>
