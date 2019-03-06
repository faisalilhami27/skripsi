@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Konfirmasi Pembayaran</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables"
                                   class="table table-responsive table-striped table-nowrap dataTable" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Kode Pemesanan</th>
                                    <th>Total Pembayaran</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Nama Customer</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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

        <div id="infoModalColoredHeader1" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-update">Update Data Konfirmasi</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <input type="hidden" id="id_konfirmasi" name="id_konfirmasi">
                            <div class="form-group">
                                <label for="upd_status" class="form-label">Status</label>
                                <select id="upd_status" name="main_menu" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    @foreach($status as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_status }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                        <strong id="id_status-error"></strong>
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

        <div id="infoModalColoredHeader2" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-update">View Bukti Pembayaran</h4>
                    </div>
                    <div class="modal-body">
                        <p class="jumlah" style="text-align: center; font-weight: bold"></p>
                        <img src="" class="gambar center-block" alt="" width="400px" height="400px">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.idle.min.js') }}"></script>
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            $("#btn-edit").attr('disabled', 'disabled');
            var styles = {
                status: function (row, type, data) {
                    if (data.id_status == 1) {
                        return "<span class='label label-danger'>Unpaid</span>";
                    } else {
                        return "<span class='label label-success'>Confirmed</span>";
                    }
                },

                images: function (row, type, data) {
                    if (data.bukti_pembayaran == null) {
                        return 'Belum konfirmasi pembayaran';
                    } else {
                        var jumlah = 'Total yang harus dibayar : Rp. ' + format(data.pemesanan_tiket.total_uang_masuk);
                        $(".gambar").attr('src', data.bukti_pembayaran);
                        $(".jumlah").html(jumlah);
                        return `<a href="#" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader2">View bukti pembayaran</a>`;
                    }
                },

                button: function (row, type, data) {
                    var update = "{{ $akses['update'] }}";
                    var hapus = "{{ $akses['delete'] }}";
                    if (update == 1 && hapus == 1) {
                        if (data.id_status == 2) {
                            return "<center>" + `<a disabled="disabled" href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}"><i class="icon icon-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + "</center>";
                        } else {
                            if (data.bukti_pembayaran == null) {
                                return "<center>" + `<a href="#" disabled='' class="btn btn-success btn-sm btn-edit"  id="${data.id}" ><i class="icon icon-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + "</center>";
                            } else {
                                return "<center>" + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + "</center>";
                            }
                        }
                    } else if (update == 1) {
                        if (data.id_status == 2) {
                            return "<center>" + `<a disabled="disabled" href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>` + "</center>";
                        } else {
                            if (data.bukti_pembayaran == null) {
                                return "<center>" + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" disabled=''><i class="icon icon-pencil-square-o"></i></a>` + "</center>";
                            } else {
                                return "<center>" + `<a href="#" class="btn btn-success btn-sm btn-edit"  id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>` + "</center>";
                            }
                        }
                    } else {
                        return "";
                    }
                },

                uang: function (row, type, data) {
                    return 'Rp. ' + format(data.pemesanan_tiket.total_uang_masuk);
                }
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                // processing: true,
                serverSide: true,
                destroy:true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('konfirmasi/json') }}',
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'bukti_pembayaran', render: styles.images},
                    {data: 'kode_pemesanan'},
                    {data: 'total_uang_masuk', render: styles.uang},
                    {data: 'pemesanan_tiket.tgl_masuk'},
                    {data: 'pemesanan_tiket.customer.nama'},
                    {data: 'id_status', render: styles.status},
                    {data: 'action', orderable: false, render: styles.button}
                ],

                columnDefs: [
                    {
                        targets: [-1, 0], //first column / numbering column
                        orderable: false, //set not orderable
                    },
                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Konfirmasi");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('konfirmasi/getKonfirmasiById') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            console.log(data);
                            $("#id_konfirmasi").val(data.list.id);
                            $("#upd_status").val(data.list.id_status);
                        } else {
                            notification(502, "Data tidak ditemukan");
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#btn-update-data").click(function (e) {
                e.preventDefault();
                var id = $("#id_konfirmasi").val();
                var id_status = $("#upd_status").val();
                var sendData = "id=" + id + "&id_status=" + id_status;
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('konfirmasi/update') }}",
                    type: "PUT",
                    data: sendData,
                    dataType: 'json',
                    success: function (data) {
                        $("#infoModalColoredHeader1").modal('hide');
                        notification(data.status, data.msg);
                        table.ajax.reload();
                    },
                    error: function (resp) {
                        if (_.has(resp.responseJSON, 'errors')) {
                            _.map(resp.responseJSON.errors, function (val, key) {
                                $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(5000);
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
                                    url: "{{ URL('konfirmasi/delete') }}",
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

            setInterval(function () {
                table.ajax.reload();
            }, 15000);
        });

        function format(angka) {
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
        }
    </script>
    <script>
        $(document).idle({
            onIdle: function () {
                window.location = "{{ URL('konfirmasi') }}";
            },
            idle: 60000
        });
    </script>
@endsection
