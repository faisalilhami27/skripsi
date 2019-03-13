@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row gutter-xs">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Menu</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables"
                                   class="table table-striped table-hover table-nowrap dataTable"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th width="20px">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>No HP</th>
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
                        <h4 class="modal-title-update">Colored Header Modal</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            @method('PUT')
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="upd_email">Email</label>
                                <input id="upd_email" name="upd_email" class="form-control" type="email"
                                       placeholder="Masukan email" maxlength="60">
                                <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_status" class="form-label">Level</label>
                                <select id="upd_status" name="upd_status" class="form-control">
                                    <option value="">-- Pilih Level --</option>
                                    <option value="0">Belum diverifikasi</option>
                                    <option value="1">Sudah diverifikasi</option>
                                </select>
                                <span class="text-danger">
                                    <strong id="status-error"></strong>
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
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            var styles = {
                button: function (row, type, data) {
                    return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                },

                status: function (row, type, data) {
                    if (data.status == 0) {
                        return '<center><span class="label label-danger">Belum diverifikasi</span></center>';
                    } else {
                        return '<center><span class="label label-success">Sudah diverifikasi</span></center>';
                    }
                }
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('customer/json') }}',
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'nama'},
                    {data: 'username'},
                    {data: 'email'},
                    {data: 'no_hp'},
                    {data: 'status', render: styles.status},
                    {data: 'action', orderable: false, render: styles.button}

                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Customer");
                $.ajax({
                    url: "{{ URL('customer/getCustomer') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id").val(data.list.id);
                            $("#upd_email").val(data.list.email);
                            $("#upd_status").val(data.list.status);
                        } else {
                            notification(data.status, data.msg);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#btn-update-data").click(function (e) {
                e.preventDefault();
                var email = $("#upd_email").val(),
                    status = $("#upd_status").val(),
                    id = $("#id").val(),
                    sendData = "id=" + id + "&email=" + email + "&status=" + status;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('customer/update') }}",
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
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    url: "{{ URL('customer/delete') }}",
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

            $("#upd_email").keyup(function (e) {
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
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#email-error").html(data.msg);
                            $("#email-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });
        });

        function loadingBeforeSend() {
            $("#btn-update-data").attr('disabled', 'disabled');
            $("#btn-update-data").text('Menyimpan data....');
        }

        function loadingAfterSend() {
            $("#btn-update-data").removeAttr('disabled');
            $("#btn-update-data").text('Submit');
        }
    </script>
@endsection
