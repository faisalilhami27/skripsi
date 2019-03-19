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
                            <strong>Daftar User</strong>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="demo-datatables" class="table table-striped table-nowrap dataTable"
                                       cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Level</th>
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
        </div>
        <div id="infoModalColoredHeader" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Tambah Data User</h4>
                    </div>
                    <form class="form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="karyawan" class="form-label">Karyawan</label>
                                <select id="karyawan" name="karyawan" class="form-control">
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach ($user as $m)
                                        <option value="<?= $m->id ?>"><?= $m->nama ?></option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="karyawan-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_username">Username</label>
                                <input id="ins_username" name="ins_username" class="form-control" type="text"
                                       placeholder="Masukan username" maxlength="60">
                                <span class="text-danger">
                                    <strong id="username-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_password">Password</label>
                                <div class="input-group">
                                    <input class="form-control form-password" id="ins_password" name="ins_password"
                                           maxlength="12" minlength="8" type="password" placeholder="Password">
                                    <span class="input-group-addon">
                                    <label class="custom-control custom-control-danger custom-checkbox">
                                        <input class="custom-control-input form-checkbox" type="checkbox">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-label">Show</span>
                                    </label>
                                </span>
                                </div>
                                <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="demo-select2-1" class="form-label">Level</label>
                                <select id="demo-select2-1" name="ins_level" class="form-control" multiple>
                                    <option value="">-- Pilih Level --</option>
                                    @foreach ($level as $m)
                                        <option value="<?= $m->id ?>"><?= $m->nama_level ?></option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                <strong id="level-error"></strong>
                            </span>
                            </div>
                            <div class="form-group">
                                <label for="demo-select2-2" class="form-label">Status</label>
                                <select id="demo-select2-2" name="ins_status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="y">Aktif</option>
                                    <option value="n">Tidak</option>
                                </select>
                                <span class="text-danger">
                                <strong id="status-error"></strong>
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
                    <form class="form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" id="id_users" name="id_users">
                            <div class="form-group">
                                <label for="upd_level" class="form-label">Level</label>
                                <select id="upd_level" name="upd_level" class="form-control" multiple>
                                    <option value="">-- Pilih Level --</option>
                                    @foreach ($level as $m)
                                        <option value="<?= $m->id ?>"><?= $m->nama_level ?></option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong class="level-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_status" class="form-label">Status</label>
                                <select id="upd_status" name="upda_status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="y">Aktif</option>
                                    <option value="n">Tidak</option>
                                </select>
                                <span class="text-danger">
                                    <strong class="status-error"></strong>
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

            $('.form-checkbox').click(function () {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });

            $("#karyawan, #upd_level").select2();

            var styles = {
                button: function (row, type, data) {
                    return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>
                                             <a href="#" id="${data.id}" class="btn btn-warning btn-sm btn-reset"><i class="icon icon-repeat"></i></a>` + '</center>';
                },
                status: function (row, type, data) {
                    if (data.status == "y") {
                        return "<center>" + "<span class='label label-primary'>Aktif</span>" + "</center>";
                    } else {
                        return "<center>" + "<span class='label label-danger'>Tidak aktif</span>" + "</center>";
                    }
                },
                level: function (row, type, data) {
                    if (data.karyawan_role != null) {
                        const numRole = data.karyawan_role.length;
                        if (numRole >= 4) {
                            return `${numRole} hak akses`
                        }

                        let arrRole = [];
                        _.each(data.karyawan_role, function(role) {
                            arrRole.push(role.role.nama_level)
                        });

                        return arrRole.join(', ');
                    }
                    return '-'
                }
            };

            //  //datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],
                ajax: {
                    "url": '{{ URL('user/json') }}',
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'karyawan.nama'},
                    {data: 'username'},
                    {data: 'karyawan.email'},
                    {data: 'nama_level', render: styles.level},
                    {data: 'status', render: styles.status},
                    {data: 'action', name: 'action', orderable: false, render: styles.button}
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
                $(".modal-title-update").html("Update Data User");
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/getUserById') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id_users").val(data.user.id);
                            $("#upd_level").select2().val(data.level).trigger('change');
                            $("#upd_status").val(data.user.status);
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
                var karyawan = $("#karyawan").val();
                var username = $("#ins_username").val();
                var password = $("#ins_password").val();
                var level = $("#demo-select2-1").val();
                var status = $("#demo-select2-2").val();
                var sendData = "karyawan=" + karyawan + "&username=" + username + "&password=" + password + "&level=" + level + "&status=" + status;

                if (level == null) {
                    $('#level-error').html('The level field is required.');
                    $('#level-error').css('color', 'red');
                    $('#level-error').fadeIn(1000);
                    $('#level-error').fadeOut(5000);
                } else {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ URL('user/insert') }}",
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
                }
            });

            $("#btn-update-data").click(function (e) {
                e.preventDefault();
                var level = $("#upd_level").val();
                var status = $("#upd_status").val();
                var id = $("#id_users").val(),
                    sendData = "id=" + id + "&level=" + level + "&status=" + status;

                if (level == null) {
                    $('.level-error').html('The level field is required.');
                    $('.level-error').css('color', 'red');
                    $('.level-error').fadeIn(1000);
                    $('.level-error').fadeOut(5000);
                } else {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ URL('user/update') }}",
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
                }
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
                                    url: "{{ URL('user/delete') }}",
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

            table.on('click', '.btn-reset', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                console.log(id);
                $.confirm({
                    content: 'Apakah yakin akan mereset password akun ini ?',
                    title: 'Reset Password',
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
                            text: '<i class="icon icon-repeat"></i> Reset',
                            btnClass: 'btn-success',
                            action: function () {
                                $.ajax({
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    },
                                    url: "{{ URL('user/resetpassword') }}",
                                    type: "PUT",
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

            $("#ins_username").keyup(function (e) {
                e.preventDefault();
                var username = $(this).val();
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('user/cekUsername') }}",
                    type: "GET",
                    data: "username=" + username,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#username-error").html("");
                            $("#btn-insert-data").removeAttr('disabled');
                        } else {
                            $("#username-error").html(data.msg);
                            $("#username-error").css("color", "red");
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
            $("#karyawan").val("");
            $("#ins_username").val("");
            $("#ins_password").val("");
            $("#demo-select2-1").val("");
            $("#demo-select2-2").val("");
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
