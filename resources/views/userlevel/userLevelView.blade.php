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
                            <strong>Daftar Level</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables" class="table table-striped table-nowrap dataTable"
                                   cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th width="20px">No</th>
                                    <th>Nama Level</th>
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
        <div id="infoModalColoredHeader" role="dialog" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title-insert">Tambah Data level</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ins_nama">Nama Level</label>
                                <input id="ins_nama" name="ins_nama" autocomplete="off" class="form-control" type="text"
                                       placeholder="Masukan nama level" maxlength="30">
                                <span class="text-danger">
                                    <strong id="nama_level-error"></strong>
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
                            <input type="hidden" id="id_level" name="id_level">
                            <div class="form-group">
                                <label for="upd_nama">Nama Level</label>
                                <input id="upd_nama" name="upd_nama" autocomplete="off" class="form-control" type="text"
                                       placeholder="Masukan nama level" maxlength="30">
                                <span class="text-danger">
                                    <strong class="nama_level-error"></strong>
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
                    return '<center>' + `<a href="{{ URL('userlevel/getakses') }}/${data.id}" id="${data.id}" class="btn btn-info btn-sm btn-akses"><i class="icon icon-eye"></i></a>
                                             <a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                }
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('userlevel/json') }}',
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'nama_level'},
                    {data: 'action', orderable: false, render: styles.button}

                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Level");
                $.ajax({
                    url: "{{ URL('userlevel/getLevelById') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id_level").val(data.list.id);
                            $("#upd_nama").val(data.list.nama_level);
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
                var nama = $("#ins_nama").val();
                var sendData = "nama_level=" + nama;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/insert') }}",
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
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
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
                var level = $("#upd_nama").val();
                var id = $("#id_level").val(),
                    sendData = "id=" + id + "&nama_level=" + level;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/update') }}",
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
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
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
                                    url: "{{ URL('userlevel/delete') }}",
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
@endsection
