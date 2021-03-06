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
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Icon</th>
                                        <th>Nomor Urut</th>
                                        <th>Main Menu</th>
                                        <th>Status</th>
                                        <th width="150px">Aksi</th>
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
                            <span aria-hidden="true">??</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Tambah Data Menu</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" class="form-control" type="text"
                                       placeholder="Masukan title menu" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong id="title-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="url">Url</label>
                                <input id="url" name="url" class="form-control" type="text"
                                       placeholder="Masukan url menu" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong id="url-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input id="icon" name="icon" class="form-control" type="text"
                                       placeholder="Masukan icon menu contoh : icon icon-user" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong id="icon-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="nomor">Nomor Urut</label>
                                <input id="nomor" name="nomor" class="form-control" type="text"
                                       placeholder="Masukan nomor urut menu contoh : 1" maxlength="4" autocomplete="off">
                                <span class="text-danger">
                                    <strong id="nomor-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="demo-select2-2" class="form-label">Main Menu</label>
                                <select id="demo-select2-2" name="main_menu" class="form-control">
                                    <option value="">-- Pilih Main Menu --</option>
                                    <option value="0">Main Menu</option>
                                    @foreach($menu as $m)
                                        <option value="<?= $m->id ?>"><?= $m->title ?></option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="is_main_menu-error"></strong>
                                </span>
                            </div>
                            <div class="form-group nomor_sub_menu" style="display: none;">
                                <label for="nomor_sub_menu">Nomor Urut Sub Menu</label>
                                <input id="nomor_sub_menu" name="nomor_sub_menu" class="form-control" type="text"
                                       placeholder="Masukan nomor urut sub menu contoh : 1" maxlength="4" autocomplete="off">
                                <span class="text-danger">
                                    <strong id="sub-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="demo-select2-1" class="form-label">Status</label>
                                <select id="demo-select2-1" name="status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="y">Aktif</option>
                                    <option value="n">Tidak</option>
                                </select>
                            </div>
                            <span class="text-danger">
                                    <strong id="is_aktif-error"></strong>
                            </span>
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
                            <span aria-hidden="true">??</span>
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
                                <label for="upd_title">Title</label>
                                <input id="upd_title" name="upd_title" class="form-control" type="text"
                                       placeholder="Masukan title menu" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong class="title-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_url">Url</label>
                                <input id="upd_url" name="upd_url" class="form-control" type="text"
                                       placeholder="Masukan url menu" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong class="url-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_icon">Icon</label>
                                <input id="upd_icon" name="upd_icon" class="form-control" type="text"
                                       placeholder="Masukan icon menu contoh : icon icon-user" maxlength="30" autocomplete="off">
                                <span class="text-danger">
                                    <strong class="icon-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_nomor">Nomor Urut</label>
                                <input id="upd_nomor" name="upd_nomor" class="form-control" type="text"
                                       placeholder="Masukan nomor urut menu contoh : 1" maxlength="4" autocomplete="off">
                                <span class="text-danger">
                                    <strong class="nomor-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_main_menu" class="form-label">Main Menu</label>
                                <select id="upd_main_menu" name="main_menu" class="form-control">
                                    <option value="">-- Pilih Main Menu --</option>
                                    <option value="0">Main Menu</option>
                                    @foreach($menu as $m)
                                        <option value="<?= $m->id ?>"><?= $m->title ?></option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong class="is_main_menu-error"></strong>
                            </span>
                            </div>
                            <div class="form-group upd_nomor_sub_menu" style="display: none">
                                <label for="upd_nomor_sub_menu">Nomor Urut Sub Menu</label>
                                <input id="upd_nomor_sub_menu" name="upd_nomor_sub_menu" class="form-control" type="text"
                                       placeholder="Masukan nomor urut menu contoh : 1" maxlength="4" autocomplete="off">
                                <span class="text-danger">
                                    <strong class="sub-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_status" class="form-label">Status</label>
                                <select id="upd_status" name="upd_status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="y">Aktif</option>
                                    <option value="n">Tidak</option>
                                </select>
                                <span class="text-danger">
                                    <strong class="is_aktif-error"></strong>
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
    @stop
@push('scripts')
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            var styles = {
                button: function (row, type, data) {
                    return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                },

                status: function (row, type, data) {
                    if (data.is_aktif == "y") {
                        return "<center>" + "<span class='label label-primary'>Aktif</span>" + "</center>";
                    } else {
                        return "<center>" + "<span class='label label-danger'>Tidak aktif</span>" + "</center>";
                    }
                },

                icon: function (row, type, data) {
                    return `<span class="${data.icon}"></span>`;
                }
            };

            $("#upd_main_menu").select2();

            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
                order: [],

                ajax: {
                    "url": '{{ URL('kelolamenu/json') }}',
                    "type": "POST",
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'title'},
                    {data: 'url'},
                    {data: 'icon', render: styles.icon},
                    {data: 'order_num'},
                    {data: 'is_main_menu'},
                    {data: 'is_aktif', render: styles.status},
                    {data: 'action', orderable: false, render: styles.button}

                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Menu");
                $.ajax({
                    url: "{{ URL('kelolamenu/getMenu') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id").val(data.list.id);
                            $("#upd_title").val(data.list.title);
                            $("#upd_url").val(data.list.url);
                            $("#upd_icon").val(data.list.icon);
                            $("#upd_nomor").val(data.list.order_num);
                            $("#upd_nomor_sub_menu").val(data.list.order_sub);
                            $("#upd_main_menu").select2().val(data.list.is_main_menu).trigger('change');
                            $("#upd_status").val(data.list.is_aktif);
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
                var subMenu = $("#nomor_sub_menu").val();
                var title = $("#title").val(),
                    url = $("#url").val(),
                    icon = $("#icon").val(),
                    nomor = $("#nomor").val(),
                    sub = $("#nomor_sub_menu").val(),
                    menu = $("#demo-select2-2").val(),
                    status = $("#demo-select2-1").val(),
                    sendData = "title=" + title + "&url=" + url + "&nomor=" + nomor + "&sub=" + sub + "&icon=" + icon + "&is_main_menu=" + menu + "&is_aktif=" + status;

                if (subMenu == '' && menu != 0) {
                    $("#sub-error").html("This number sub menu is required");
                    $("#sub-error").css("color", "red");
                    $("#sub-error").fadeIn(1000);
                    $("#sub-error").fadeOut(5000);
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ URL('kelolamenu/insert') }}",
                        type: "POST",
                        data: sendData,
                        dataType: 'json',
                        beforeSend: function () {
                            loadingBeforeSend();
                        },
                        success: function (data) {
                            notification(data.status, data.msg);
                            $('#infoModalColoredHeader').modal('hide');
                            loadingAfterSend();
                            resetForm();
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
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
                var subMenu = $("#upd_nomor_sub_menu").val();
                var title = $("#upd_title").val(),
                    url = $("#upd_url").val(),
                    icon = $("#upd_icon").val(),
                    nomor = $("#upd_nomor").val(),
                    menu = $("#upd_main_menu").val(),
                    sub = $("#upd_nomor_sub_menu").val(),
                    status = $("#upd_status").val(),
                    id = $("#id").val(),
                    sendData = "id=" + id + "&title=" + title + "&nomor=" + nomor + "&sub=" + sub + "&url=" + url + "&icon=" + icon + "&is_main_menu=" + menu + "&is_aktif=" + status;

                if (subMenu == '' && menu != 0) {
                    $(".sub-error").html("This number sub menu is required");
                    $(".sub-error").css("color", "red");
                    $(".sub-error").fadeIn(1000);
                    $(".sub-error").fadeOut(5000);
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        url: "{{ URL('kelolamenu/update') }}",
                        type: "PUT",
                        data: sendData,
                        dataType: 'json',
                        beforeSend: function () {
                            loadingBeforeSend();
                        },
                        success: function (data) {
                            notification(data.status, data.msg);
                            $('#infoModalColoredHeader1').modal('hide');
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
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
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    url: "{{ URL('kelolamenu/delete') }}",
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

            $("#nomor_sub_menu, #upd_nomor_sub_menu").keyup(function (e) {
                e.preventDefault();
                var nomor = $(this).val();
                var reg = /^\d+$/;

                if (!nomor.match(reg)) {
                    $(".sub-error, #sub-error").html("This number sub menu must be number format");
                    $(".sub-error, #sub-error").css("color", "red");
                    $(".sub-error, #sub-error").fadeIn(1000);
                    $(".sub-error, #sub-error").fadeOut(5000);
                    $("#btn-insert-data, #btn-update-data").attr('disabled', true);
                } else {
                    $("#btn-insert-data, #btn-update-data").removeAttr('disabled');
                }
            });

            $("#upd_main_menu, #demo-select2-2").change(function (e) {
                e.preventDefault();
                var menu = $(this).val();
                if (menu == 0 || menu == '') {
                    $(".upd_nomor_sub_menu, .nomor_sub_menu").slideUp(1000);
                } else {
                    $(".upd_nomor_sub_menu, .nomor_sub_menu").slideDown(1000);
                }
            });
        });

        function resetForm() {
            $("#title").val("");
            $("#url").val("");
            $("#icon").val("");
            $("#nomor").val("");
            $("#main_menu").val("");
            $("#status").val("");
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
@endpush
