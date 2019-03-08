@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            @if($akses['create'] == 1)
                <button class="btn btn-info btn-sm" type="button" data-toggle="modal"
                        data-target="#infoModalColoredHeader"
                        style="margin-bottom: 10px"><i class="icon icon-plus-circle"></i> Tambah
                </button>
            @endif
            <button class="btn btn-success btn-sm" type="button" id="btnRefresh"
                    style="margin-bottom: 10px"><i class="icon icon-refresh"></i> Refresh
            </button>
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Pemesanan Tiket</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="demo-datatables" class="table table-responsive table-striped dataTable"
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">No</th>
                                        <th style="text-align: center">Kode</th>
                                        <th style="text-align: center">Tanggal</th>
                                        <th style="text-align: center">Nama kasir</th>
                                        <th style="text-align: center">Jumlah Tiket</th>
                                        <th style="text-align: center">Pembayaran</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Jenis</th>
                                        <th style="text-align: center" width="120px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="infoModalColoredHeader" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Tambah Data Pemesanan Tiket</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-sm" type="button" id="btnTiket1"
                                            style="margin-bottom: 10px;">Pemesanan 1 Tiket
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-sm" type="button" id="btnTiket2"
                                            style="margin-bottom: 10px;">Pemesanan 2 Tiket
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-sm" type="button" id="btnTiket3"
                                            style="margin-bottom: 10px;">Pemesanan 3 Tiket
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-sm" type="button" id="btnTiket4"
                                            style="margin-bottom: 10px;">Pemesanan 4 Tiket
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ins_tiket">Jumlah Tiket</label>
                                <input id="ins_tiket" name="ins_tiket" maxlength="5" class="form-control" type="text"
                                       placeholder="Masukan jumlah tiket">
                                <span class="text-danger">
                                    <strong id="tiket-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_pembayaran">Jumlah Uang</label>
                                <input id="ins_pembayaran" name="ins_pembayaran" data-a-sep="." class="form-control"
                                       type="text"
                                       placeholder="Masukan jumlah uang" maxlength="20">
                                <span class="text-danger">
                                    <strong id="pembayaran-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_uang">Total Pembayaran</label>
                                <input id="ins_uang" name="ins_uang" data-a-sep="." class="form-control" readonly
                                       type="text"
                                       placeholder="Masukan jumlah uang" maxlength="20">
                                <span class="text-danger">
                                    <strong id="total-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_kembalian">Uang Kembalian</label>
                                <input id="ins_kembalian" name="ins_kembalian" data-a-sep="." class="form-control"
                                       readonly
                                       type="text"
                                       placeholder="Masukan jumlah uang" maxlength="20">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-primary" id="btn-insert-data" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="infoModalColoredHeader1" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-update">Colored Header Modal</h4>
                    </div>
                    <form class="form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_trs" name="id_trs">
                            <input type="hidden" id="id_jenis" name="id_jenis" value="1">
                            <div class="form-group">
                                <label for="upd_tiket">Jumlah Tiket</label>
                                <input id="upd_tiket" name="upd_tiket" maxlength="5" class="form-control"
                                       type="text" placeholder="Masukan jumlah tiket" min="1">
                                <span class="text-danger">
                                    <strong class="tiket-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_uang">Total Pembayaran</label>
                                <input id="upd_uang" name="upd_uang" class="form-control" readonly type="text"
                                       placeholder="Masukan jumlah uang">
                                <span class="text-danger">
                                    <strong class="total-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                            <button class="btn btn-primary" id="btn-update-data" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.idle.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var format = function (angka) {
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
                return rupiah;
            };

            var styles = {
                status: function (row, type, data) {
                    if (data.status_penggunaan == 0) {
                        return "<center>" + "<span class='label label-danger'>Belum diverifikasi</span>" + "<center>";
                    } else {
                        return "<center>" + "<span class='label label-info'>Sudah diverifikasi</span>" + "<center>";
                    }
                },

                button: function (row, type, data) {
                    var update = "{{ $akses['update'] }}";
                    var hapus = "{{ $akses['delete'] }}";
                    if (update == 1 && hapus == 1) {
                        if (data.id_jenis == 2) {
                            return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                                 <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                        } else {
                            return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                                 <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>
                                                 <a href="#" class="btn btn-warning btn-sm btn-print"  id="${data.kode_pemesanan}"><i class="icon icon-print"></i></a>` + '</center>';
                        }
                    } else if (update == 1) {
                        if (data.id_jenis == 2) {
                            return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>` + '</center>';
                        } else {
                            return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                                 <a href="#" class="btn btn-warning btn-sm btn-print"  id="${data.kode_pemesanan}"><i class="icon icon-print"></i></a>` + '</center>';
                        }
                    } else {
                        if (data.id_jenis == 2) {
                            return '<center>' + 'Tidak ada aksi' + '</center>';
                        } else {
                            return '<center>' + `<a href="#" class="btn btn-warning btn-sm btn-print"  id="${data.kode_pemesanan}"><i class="icon icon-print"></i></a>` + '</center>';
                        }
                    }
                },

                jenis: function (row, type, data) {
                    if (data.jenis_pemesanan.nama_jenis == "Langsung") {
                        return "<center>" + "<span class='label label-success'>" + data.jenis_pemesanan.nama_jenis + "</span>" + "<center>";
                    } else {
                        return "<center>" + "<span class='label label-warning'>" + data.jenis_pemesanan.nama_jenis + "</span>" + "<center>";
                    }
                },

                uang: function (row, type, data) {
                    return "Rp. " + format(data.total_uang_masuk);
                },

                karyawan: function (row, type, data) {
                    if (data.id_karyawan == null) {
                        return '-';
                    } else {
                        return data.karyawan.karyawan.nama;
                    }
                }
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                // processing: true,
                autowidth: true,
                serverSide: true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('pemesanan/json') }}',
                    "cache": false,
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'kode_pemesanan'},
                    {data: 'tgl_pemesanan'},
                    {data: 'karyawan', render: styles.karyawan},
                    {data: 'jumlah_tiket'},
                    {data: 'total_uang_masuk', render: styles.uang},
                    {data: 'status_penggunaan', render: styles.status},
                    {data: 'jenis_pemesanan', render: styles.jenis},
                    {data: 'action', orderable: false, searchable: false, render: styles.button}

                ],

                columnDefs: [
                    {
                        targets: [-1, 0], //first column / numbering column
                        orderable: false, //set not orderable
                    },
                ],
            });

            $("#ins_tiket, #upd_tiket").keyup(function () {
                var jml_tiket = $(this).val();
                if (jml_tiket <= 0) {
                    $("#tiket-error, .tiket-error").html('can not be 0 or negative');
                    $("#tiket-error, .tiket-error").css('color', 'red');
                    $("#tiket-error, .tiket-error").fadeIn(1000);
                    $("#tiket-error, .tiket-error").fadeOut(5000);
                    $("#btn-insert-data").attr("disabled", 'disabled');
                    $("#btn-update-data").attr("disabled", 'disabled');
                } else {
                    $("#tiket-error").html('');
                    $("#btn-insert-data").removeAttr("disabled");
                    $("#btn-update-data").removeAttr("disabled");

                    var jml_uang = jml_tiket * "{{ $konfig[2]->nilai_konfig }}";
                    var bilangan = jml_uang;

                    var reverse = bilangan.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#ins_uang, #upd_uang").val(ribuan);
                }
            });

            $('#ins_pembayaran').keyup(function () {
                $(this).val(format($(this).val()));
                var pembayaran = $(this).val();
                var jml_uang = $("#ins_uang").val();
                var bayar = pembayaran.split('.').join('');
                var uang = jml_uang.split('.').join('');
                var kembalian = bayar - uang;
                var reverse = kembalian.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g),
                    ribuan = ribuan.join('.').split('').reverse().join('');
                $("#ins_kembalian").val(ribuan);
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Pemesanan");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('pemesanan/getPemesananById') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            var reverse = data.list.total_uang_masuk.toString().split('').reverse().join(''),
                                ribuan = reverse.match(/\d{1,3}/g),
                                ribuan = ribuan.join('.').split('').reverse().join('');
                            $("#id_trs").val(data.list.id);
                            $("#upd_tiket").val(data.list.jumlah_tiket);
                            $("#upd_uang").val(ribuan);
                        } else {
                            notification(502, "Data tidak ditemukan");
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#btn-insert-data").click(function (e) {
                e.preventDefault();
                var jml_tiket = $("#ins_tiket").val();
                var pembayaran = $("#ins_pembayaran").val();
                var total = $("#ins_uang").val();
                var replace_total = total.split('.').join('');
                var replace_pembayaran = pembayaran.split('.').join('');
                var sendData = sendData = "tiket=" + jml_tiket + "&pembayaran=" + replace_pembayaran + "&total=" + replace_total;

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('pemesanan/insert') }}",
                    type: "POST",
                    data: sendData,
                    dataType: 'json',
                    beforeSend: function() {
                        loadingBeforeSend();
                    },
                    success: function (data) {
                        $("#infoModalColoredHeader").modal('hide');
                        loadingAfterSend();
                        notification(data.status, data.msg);
                        table.ajax.reload();
                    },
                    error: function (resp) {
                        loadingAfterSend();
                        if (_.has(resp.responseJSON, 'errors')) {
                            _.map(resp.responseJSON.errors, function (val, key) {
                                $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                            })
                        }
                        alert(resp.responseJSON.message)
                    }
                });
            });

            $("#btn-update-data").click(function (e) {
                e.preventDefault();
                var id = $("#id_trs").val();
                var jml_tiket = $("#upd_tiket").val();
                var total = $("#upd_uang").val();
                var replace_total = total.split('.').join('');
                var sendData = "id=" + id + "&tiket=" + jml_tiket + "&total=" + replace_total;
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('pemesanan/update') }}",
                    type: "PUT",
                    data: sendData,
                    dataType: 'json',
                    beforeSend: function() {
                      loadingBeforeSend();
                    },
                    success: function (data) {
                        $("#infoModalColoredHeader1").modal('hide');
                        loadingAfterSend();
                        notification(data.status, data.msg);
                        table.ajax.reload();
                    },
                    error: function (resp) {
                        loadingAfterSend();
                        if (_.has(resp.responseJSON, 'errors')) {
                            _.map(resp.responseJSON.errors, function (val, key) {
                                $('.' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
                            })
                        }
                        alert(resp.responseJSON.message)
                    }
                });
            });

            table.on('click', '.btn-delete', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $.confirm({
                    content: 'Data yang dihapus tidak akan dapat dikembalikan.',
                    title: 'Apakah yakin ingin menghapus ?',
                    type: 'red',
                    typeAnimated: true,
                    buttons: {
                        cancel: {
                            text: 'Batal',
                            btnClass: 'btn-danger',
                            keys: ['esc'],
                            action: function () {
                            }
                        },
                        ok: {
                            text: '<i class="icon icon-trash"></i> Hapus',
                            btnClass: 'btn-warning',
                            action: function () {
                                $.ajax({
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    },
                                    url: "{{ URL('pemesanan/delete') }}",
                                    type: "DELETE",
                                    data: "id=" + id,
                                    dataType: "json",
                                    success: function (data) {
                                        notification(data.status, data.msg);
                                        table.ajax.reload();
                                    },
                                    error: function (xhr, status, error) {
                                        alert(status + " : " + error);
                                    }
                                });
                            }
                        }
                    }
                });
            });

            table.on('click', '.btn-print', function () {
                var id = $(this).attr('id');
                console.log(id);
                var url = '{{ URL('pemesanan/printTicket')}}' + '/' + id;
                var W = window.open(url);
                W.window.print();
            });

            $("#btnRefresh").click(function () {
                table.ajax.reload();
            });

            setInterval(function () {
                table.ajax.reload();
            }, 15000);

            $("#btnTiket1").click(function () {
                var tiket = 1;
                var pembayaran = $("#ins_pembayaran").val();
                var harga = "{{ $konfig[2]->nilai_konfig }}";
                var total = tiket * harga;
                var reverse = total.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                $("#ins_uang").val(ribuan);
                $("#ins_tiket").val(tiket);
                if (pembayaran == '') {
                    $("#ins_kembalian").val('');
                } else {
                    var bayar = pembayaran.split('.').join('');
                    var kembalian = bayar - total;
                    var uangKembalian = kembalian.toString().split('').reverse().join(''),
                        ribuan = uangKembalian.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#ins_kembalian").val(ribuan);
                }
            });

            $("#btnTiket2").click(function () {
                var tiket = 2;
                var pembayaran = $("#ins_pembayaran").val();
                var harga = "{{ $konfig[2]->nilai_konfig }}";
                var total = tiket * harga;
                var reverse = total.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                $("#ins_uang").val(ribuan);
                $("#ins_tiket").val(tiket);
                if (pembayaran == '') {
                    $("#ins_kembalian").val('');
                } else {
                    var bayar = pembayaran.split('.').join('');
                    var kembalian = bayar - total;
                    var uangKembalian = kembalian.toString().split('').reverse().join(''),
                        ribuan = uangKembalian.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#ins_kembalian").val(ribuan);
                }
            });

            $("#btnTiket3").click(function () {
                var tiket = 3;
                var pembayaran = $("#ins_pembayaran").val();
                var harga = "{{ $konfig[2]->nilai_konfig }}";
                var total = tiket * harga;
                var reverse = total.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                $("#ins_uang").val(ribuan);
                $("#ins_tiket").val(tiket);
                if (pembayaran == '') {
                    $("#ins_kembalian").val('');
                } else {
                    var bayar = pembayaran.split('.').join('');
                    var kembalian = bayar - total;
                    var uangKembalian = kembalian.toString().split('').reverse().join(''),
                        ribuan = uangKembalian.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#ins_kembalian").val(ribuan);
                }
            });

            $("#btnTiket4").click(function () {
                var tiket = 4;
                var pembayaran = $("#ins_pembayaran").val();
                var harga = "{{ $konfig[2]->nilai_konfig }}";
                var total = tiket * harga;
                var reverse = total.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                $("#ins_uang").val(ribuan);
                $("#ins_tiket").val(tiket);
                if (pembayaran == '') {
                    $("#ins_kembalian").val('');
                } else {
                    var bayar = pembayaran.split('.').join('');
                    var kembalian = bayar - total;
                    var uangKembalian = kembalian.toString().split('').reverse().join(''),
                        ribuan = uangKembalian.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    $("#ins_kembalian").val(ribuan);
                }
            });
        });

        function loadingBeforeSend() {
            $("#btn-insert-data, #btn-update-data").attr('disabled', 'disabled');
            $("#btn-insert-data, #btn-update-data").text('Menyimpan data....');
        }

        function loadingAfterSend() {
            $("#btn-insert-data, #btn-update-data").removeAttr('disabled');
            $("#btn-insert-data, #btn-update-data").text('Submit');
        }
    </script>
    <script>
        $(document).idle({
            onIdle: function () {
                window.location = "{{ URL('pemesanan') }}";
            },
            idle: 60000
        });
    </script>
@endsection
