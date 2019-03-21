@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <button class="btn btn-info btn-sm" type="button" data-toggle="modal" data-target="#infoModalColoredHeader"
                    style="margin-bottom: 10px"><i class="icon icon-plus-circle"></i> Tambah
            </button>
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Menu</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="demo-datatables"
                                       class="table table-striped table-hover table-nowrap dataTable"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th width="20px">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>No HP</th>
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
        </div>
        <div id="infoModalColoredHeader" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Tambah Data Menu</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input id="nama" name="nama" class="form-control" type="text"
                                       placeholder="Masukan nama" maxlength="60">
                                <span class="text-danger">
                                    <strong id="nama-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" class="form-control" type="text"
                                       placeholder="Masukan email" maxlength="60">
                                <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Handphone</label>
                                <input id="no_hp" name="no_hp" class="form-control" type="text"
                                       placeholder="Masukan nomor hp" maxlength="15">
                                <span class="text-danger">
                                    <strong id="noHp-error"></strong>
                                </span>
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
                    <form class="form" method="post">
                        <div class="modal-body">
                            @method('PUT')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="upd_nama">Nama Lengkap</label>
                                <input id="upd_nama" name="upd_nama" class="form-control" type="text"
                                       placeholder="Masukan nama" maxlength="60">
                                <span class="text-danger">
                                    <strong class="nama-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_email">Email</label>
                                <input id="upd_email" name="upd_email" class="form-control" type="text"
                                       placeholder="Masukan email" maxlength="60">
                                <span class="text-danger">
                                    <strong class="email-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_no_hp">Nomor Handphone</label>
                                <input id="upd_no_hp" name="upd_no_hp" class="form-control" type="text"
                                       placeholder="Masukan nomor hp" maxlength="15">
                                <span class="text-danger">
                                    <strong class="noHp-error"></strong>
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
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            var styles = {
                button: function (row, type, data) {
                    return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                },
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('karyawan/json') }}',
                    "type": "POST",
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'nama'},
                    {data: 'email'},
                    {data: 'no_hp'},
                    {data: 'action', orderable: false, render: styles.button}

                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Karyawan");
                $.ajax({
                    url: "{{ URL('karyawan/getKaryawan') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id").val(data.list.id);
                            $("#upd_nama").val(data.list.nama);
                            $("#upd_email").val(data.list.email);
                            $("#upd_no_hp").val(data.list.no_hp);
                        } else {
                            notification(data.status, data.msg);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#btn-insert-data").click(function (e) {
                e.preventDefault();
                var nama = $("#nama").val(),
                    email = $("#email").val(),
                    no_hp = $("#no_hp").val(),
                    sendData = "nama=" + nama + "&email=" + email + "&noHp=" + no_hp;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('karyawan/insert') }}",
                    type: "POST",
                    data: sendData,
                    dataType: 'json',
                    beforeSend: function() {
                      loadingBeforeSend();
                    },
                    success: function (data) {
                        notification(data.status, data.msg);
                        $('#infoModalColoredHeader').modal('hide');
                        loadingAfterSend();
                        resetForm();
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
                var nama = $("#upd_nama").val(),
                    email = $("#upd_email").val(),
                    no_hp = $("#upd_no_hp").val(),
                    id = $("#id").val(),
                    sendData = "id=" + id + "&nama=" + nama + "&email=" + email + "&noHp=" + no_hp;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('karyawan/update') }}",
                    type: "PUT",
                    data: sendData,
                    dataType: 'json',
                    beforeSend: function() {
                      loadingBeforeSend();
                    },
                    success: function (data) {
                        notification(data.status, data.msg);
                        $('#infoModalColoredHeader1').modal('hide');
                        loadingAfterSend();
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
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    url: "{{ URL('karyawan/delete') }}",
                                    type: "DELETE",
                                    data: "id=" + id,
                                    dataType: "json",
                                    success: function (data) {
                                        notification(data.status, data.msg);
                                        setTimeout(function () {
                                            location.reload();
                                        }, 1000)
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

            $("#no_hp, #upd_no_hp").keyup(function (e) {
                e.preventDefault();
                var noHp = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/cekNoHp') }}",
                    type: "GET",
                    data: "noHp=" + noHp,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#noHp-error, .noHp-error").html("");
                            $("#btn-insert-data").removeAttr('disabled');
                        } else {
                            $("#noHp-error, .noHp-error").html(data.msg);
                            $("#noHp-error, .noHp-error").css("color", "red");
                            $("#btn-insert-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#email, #upd_email").keyup(function (e) {
                e.preventDefault();
                var email = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/cekEmail') }}",
                    type: "GET",
                    data: "email=" + email,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#email-error").html("");
                            $("#btn-insert-data").removeAttr('disabled');
                        } else {
                            $("#email-error").html(data.msg);
                            $("#email-error").css("color", "red");
                            $("#btn-insert-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });
        });

        function resetForm() {
            $("#ins_nama").val("");
            $("#ins_email").val("");
            $("#ins_no_hp").val("");
        }

        function loadingBeforeSend() {
            $("#btn-insert-data, #btn-update-data").attr('disabled', 'disabled');
            $("#btn-insert-data, #btn-update-data").text('Menyimpan data....');
        }

        function loadingAfterSend() {
            $("#btn-insert-data, #btn-update-data").removeAttr('disabled');
            $("#btn-insert-data, #btn-update-data").text('Submit');
        }
    </script>
@endsection
