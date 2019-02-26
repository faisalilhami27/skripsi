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
                            <table id="demo-datatables" class="table table-striped table-nowrap dataTable"
                                   cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
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
                                <label for="ins_nama">Nama Lengkap</label>
                                <input id="ins_nama" name="ins_nama" class="form-control" type="text"
                                       placeholder="Masukan nama user" maxlength="60">
                                <span class="text-danger">
                                <strong id="nama-error"></strong>
                            </span>
                            </div>
                            <div class="form-group">
                                <label for="ins_email">Email</label>
                                <input id="ins_email" name="ins_email" class="form-control" type="email"
                                       placeholder="Masukan email" maxlength="60">
                                <span class="text-danger">
                                <strong id="email-error"></strong>
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
                                <label for="ins_images">Images</label>
                                <div class="input-with-icon">
                                    <div class="input-group input-file">
                                        <input class="form-control" readonly type="text" placeholder="No file chosen"
                                               style="background-color: rgba(0,0,0, 0.1)">
                                        <span class="icon icon-paperclip input-icon"></span>
                                        <span class="input-group-btn">
                                        <label class="btn btn-primary file-upload-btn">
                                            <input id="ins_images" type="file" accept="image/*"
                                                   class="file-upload-input" name="ins_images">
                                            <span class="icon icon-paperclip icon-lg"></span>
                                        </label>
                                    </span>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    <strong id="images-error"></strong>
                                </span>
                                <p class="help-block">
                                    <small>Allowed types: png gif jpg jpeg.</small>
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="demo-select2-1" class="form-label">Level</label>
                                <select id="demo-select2-1" name="ins_level" class="form-control">
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
                                <select id="upd_level" name="upd_level" class="form-control">
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
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

                $('input[type=file]').change(function () {
                    var val = $(this).val().toLowerCase(),
                        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");
                    if (!(regex.test(val))) {
                        $(this).val('');
                        alert('Format yang diizinkan png atau jpg');
                    } else if (this.files[0].size > 1000024) {
                        $(this).val('');
                        $("#images-error").html("Maximum file size of 1 MB").fadeIn(1000).fadeOut(5000);
                        $("#images-error").css("color", "red");
                    }
                });

                var styles = {
                    button: function (row, type, data) {
                        if (data.id_user_level == 1) {
                            return '<center>' + `<a href="#" id="${data.id}" class="btn btn-warning btn-sm btn-reset"><i class="icon icon-repeat"></i></a>` + '</center>';
                        } else {
                            return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>
                                             <a href="#" id="${data.id}" class="btn btn-warning btn-sm btn-reset"><i class="icon icon-repeat"></i></a>` + '</center>';
                        }
                    },
                    status: function (row, type, data) {
                        if (data.status == "y") {
                            return "<center>" + "<span class='label label-primary'>Aktif</span>" + "</center>";
                        } else {
                            return "<center>" + "<span class='label label-danger'>Tidak aktif</span>" + "</center>";
                        }
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
                        {data: 'nama'},
                        {data: 'email'},
                        {data: 'user_level.nama_level'},
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
                                $("#upd_level").val(data.user.id_user_level);
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
                    var nama = $("#ins_nama").val();
                    var email = $("#ins_email").val();
                    var password = $("#ins_password").val();
                    var level = $("#demo-select2-1").val();
                    var status = $("#demo-select2-2").val();
                    var images = $('#ins_images').prop('files')[0];
                    var formData = new FormData();
                    formData.append('nama', nama);
                    formData.append('email', email);
                    formData.append('password', password);
                    formData.append('level', level);
                    formData.append('status', status);
                    formData.append('images', images);
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ URL('user/insert') }}",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {
                            $("#infoModalColoredHeader").modal('hide');
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

                $("#btn-update-data").click(function (e) {
                    e.preventDefault();
                    var level = $("#upd_level").val();
                    var status = $("#upd_status").val();
                    var id = $("#id_users").val(),
                        sendData = "id=" + id + "&level=" + level + "&status=" + status;
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ URL('user/update') }}",
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

                $("#ins_email").keyup(function (e) {
                    e.preventDefault();
                    var email = $(this).val();
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        url: "{{ URL('user/cekemail') }}",
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

                $(function () {
                    // We can attach the `fileselect` event to all file inputs on the page
                    $(document).on('change', ':file', function () {
                        var input = $(this),
                            numFiles = input.get(0).files ? input.get(0).files.length : 1,
                            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                        input.trigger('fileselect', [numFiles, label]);
                    });

                    // We can watch for our custom `fileselect` event like this
                    $(document).ready(function () {
                        $(':file').on('fileselect', function (event, numFiles, label) {

                            var input = $(this).parents('.input-file').find(':text'),
                                log = numFiles > 1 ? numFiles + ' files selected' : label;

                            if (input.length) {
                                input.val(log);
                            } else {
                                if (log) alert(log);
                            }

                        });
                    });
                });
            });
        </script>
@endsection
