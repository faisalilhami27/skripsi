<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rekapitulasi Kehadiran Karyawan</title>
  <style type="text/css">
    .kehadiran {
      padding: 0;
      margin: 0;
      background-color: rgba(46, 204, 113, 1);
      color: #000;
      font-size: 11px;
      font-weight: bold;
    }

    .izin {
      padding: 0;
      margin: 0;
      background-color: rgba(25, 181, 254, 1);
      color: #000;
      font-size: 11px;
      font-weight: bold;
    }

    .sakit {
      padding: 0;
      margin: 0;
      background-color: rgba(254, 241, 96, 1);
      color: #000;
      font-size: 11px;
      font-weight: bold;
    }

    .alfa {
      padding: 0;
      margin: 0;
      background-color: rgba(242, 38, 19, 1);
      color: #000;
      font-size: 11px;
      font-weight: bold;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table td {
      border: #000 1px solid;
    }

    /* provide some minimal visual accomodation for IE8 and below */
    .table tr {
      background: #b8d1f3;
    }

    /*  Define the background color for all the ODD background rows  */
    .table tr:nth-child(odd) {
      background: #b8d1f3;
    }

    /*  Define the background color for all the EVEN background rows  */
    .table tr:nth-child(even) {
      background: #dae5f4;
    }

    /* if the browser window is at least 800px-s wide: */
    @media screen and (min-width: 800px) {
      table {
        width: 90%;}
    }

    /* if the browser window is at least 1000px-s wide: */
    @media screen and (min-width: 1000px) {
      table {
        width: 80%;}
    }
  </style>
</head>
<body>
<div align="center">
  <h3>Daftar Kehadiran Karyawan Bulan {{ monthConverter(date('n')) }} Tahun {{ date('Y') }}</h3>
</div>
<br>
@php $jumlahHari = date('t'); @endphp
<div align="center">
  <table border="1" class="table" cellpadding="">
    <thead>
    <tr>
      <td rowspan="2" align="center" width="40"><b>No</b></td>
      <td rowspan="2" width="150" align="center"><b>Nama</b></td>
      <td colspan="{{ $jumlahHari }}" align="center"><b style="font-size: 15px">{{ monthConverter(date('n')) }}</b></td>
      <td colspan="4" align="center"><b style="font-size: 15px">Keterangan</b></td>
    </tr>
    <tr>
      @for ($i = 1; $i <= $jumlahHari; $i++)
        <td align="center" width="15"><b style="font-size: 12px">{{ $i }}</b></td>
      @endfor
      <td align="center"><b style="font-size: 12px">H</b></td>
      <td align="center"><b style="font-size: 12px">S</b></td>
      <td align="center"><b style="font-size: 12px">I</b></td>
      <td align="center"><b style="font-size: 12px">A</b></td>
    </tr>
    </thead>
    @php $no = 1 @endphp
    @foreach ($karyawan as $s)
      <tr>
        <td align="center"><span style="font-size: 12px;">{{ $no++ }}</span></td>
        <td><span style="font-size: 12px; padding-left: 2px;">{{ $s->nama }}</span></td>
        @for ($i = 1; $i <= $jumlahHari; $i++)
          @php $statusText = null; $foundDate = false; @endphp
          @foreach(cekStatusKehadiranKaryawan($s->id) as $d)
            @if(date('j', strtotime($d->tanggal)) == $i)
              @switch($d->status)
                @case(1)
                @php $statusText = '<td align="center" class="alfa">A</td>' @endphp
                @break
                @case(2)
                @php $statusText = '<td align="center" class="kehadiran">H</td>' @endphp
                @break
                @case(3)
                @php $statusText = '<td align="center" class="izin">I</td>' @endphp
                @break
                @case(4)
                @php $statusText = '<td align="center" class="sakit">S</td>' @endphp
                @break
              @endswitch
              @php $foundDate = true @endphp
            @endif
          @endforeach

          @if($foundDate == true)
            {!! $statusText !!}
          @else
            <td></td>
          @endif
        @endfor
        <td align="center" width="15" style="padding: 0; margin: 0" class="kehadiran">
          <span style="color: #000; font-size: 12px"><b>{{ countStatusKehadiranKaryawan($s->id, 2) }}</b></span>
        </td>
        <td align="center" width="15" style="padding: 0; margin: 0" class="sakit">
          <span style="color: #000; font-size: 12px"><b>{{ countStatusKehadiranKaryawan($s->id, 4) }}</b></span>
        </td>
        <td align="center" width="15" style="padding: 0; margin: 0" class="izin">
          <span style="color: #000; font-size: 12px"><b>{{ countStatusKehadiranKaryawan($s->id, 3) }}</b></span>
        </td>
        <td align="center" width="15" style="padding: 0; margin: 0" class="alfa">
          <span style="color: #000; font-size: 12px"><b>{{ countStatusKehadiranKaryawan($s->id, 1) }}</b></span>
        </td>
      </tr>
    @endforeach
  </table>
</div>
<br>
<div style="margin-left: 0px">
  <p>Keterangan : </p>
  <table>
    <tr>
      <td><div class="kehadiran" style="width: 20px; text-align: center">H</div></td>
      <td>:</td>
      <td>Hadir</td>
    </tr>
    <tr>
      <td><div class="izin" style="width: 20px; text-align: center">I</div></td>
      <td>:</td>
      <td>Izin</td>
    </tr>
    <tr>
      <td><div class="sakit" style="width: 20px; text-align: center">S</div></td>
      <td>:</td>
      <td>Sakit</td>
    </tr>
    <tr>
      <td><div class="alfa" style="width: 20px; text-align: center">A</div></td>
      <td>:</td>
      <td>Tanpa Keterangan</td>
    </tr>
  </table>
</div>
</body>
</html>
