@extends('template')
@section('content')
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
                                        <td>{{ $data->kode_pemesanan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pemesanan</td>
                                        <td>{{ $data->tgl_pemesanan }}</td>
                                    </tr>
                                    @if($data->id_jenis == 2)
                                        <tr>
                                            <td>Batas Masuk</td>
                                            <td>{{ $nextDay }}</td>
                                        </tr>
                                    @endif
                                    @if($data->id_customer != 0)
                                        <tr>
                                            <td>Nama Customer</td>
                                            <td>{{ $data->customer->nama }}</td>
                                        </tr>
                                    @endif
                                   @if(!is_null($data->id_karyawan))
                                        <tr>
                                            <td>Nama Karyawan</td>
                                            <td>{{ $data->karyawan->karyawan->nama }}</td>
                                        </tr>
                                   @endif
                                    <tr>
                                        <td>Jumlah Tiket</td>
                                        <td>{{ $data->jumlah_tiket }} Tiket</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pembayaran</td>
                                        <td>Rp. {{ number_format($data->total_uang_masuk, 0, ".", ".") }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Penggunaan</td>
                                        <td>
                                            @if($data->status_penggunaan == 1)
                                                <span class="label label-info">Sudah diverifikasi</span>
                                            @else
                                                <span class="label label-danger">Belum diverifikasi</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Pemesanan</td>
                                        <td>
                                            @if($data->id_jenis == 1)
                                                <span class="label label-success">{{ $data->jenisPemesanan->nama_jenis }}</span>
                                            @else
                                                <span class="label label-warning">{{ $data->jenisPemesanan->nama_jenis }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="{{ URL('pemesanan') }}" class="btn btn-primary"><i class="icon icon-backward"></i> Back</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
