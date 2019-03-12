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
                            <strong>Daftar Content Aplikasi Mobile</strong>
                        </div>
                        <div class="card-body">
                            <table id="demo-datatables"
                                   class="table table-striped table-hover table-nowrap dataTable"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th width="20px">No</th>
                                    <th>Images</th>
                                    <th>Title</th>
                                    <th>Deskripsi</th>
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
                        <h4 class="modal-title-insert">Tambah Data Konfigurasi</h4>
                    </div>
                    <form class="form" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" class="form-control" type="text"
                                       placeholder="Masukan title" maxlength="30">
                                <span class="text-danger">
                                    <strong id="title-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="control-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" maxlength="80" placeholder="Masukan deskripsi" name="deskripsi" rows="3" required></textarea>
                                <span class="text-danger">
                                    <strong id="deskripsi-error"></strong>
                                </span>
                                <span>
                                    <strong style="float: right;"><strong id="countCharacters">80</strong> characters remaining</strong>
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
                                <label for="upd_title">Title</label>
                                <input id="upd_title" name="upd_title" class="form-control" type="text"
                                       placeholder="Masukan title" maxlength="30">
                                <span class="text-danger">
                                    <strong class="title-error"></strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_deskripsi" class="control-label">Deskripsi</label>
                                <textarea id="upd_deskripsi" class="form-control" maxlength="80" placeholder="Masukan deskripsi" name="upd_deskripsi" rows="3" required></textarea>
                                <span class="text-danger">
                                    <strong class="deskripsi-error"></strong>
                                </span>
                                <span>
                                    <strong style="float: right;"><strong class="countCharacters">0</strong> characters remaining</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="upd_images">Images</label>
                                <div class="input-with-icon">
                                    <div class="input-group input-file">
                                        <input class="form-control" readonly type="text" placeholder="No file chosen"
                                               style="background-color: rgba(0,0,0, 0.1)">
                                        <span class="icon icon-paperclip input-icon"></span>
                                        <span class="input-group-btn">
                                        <label class="btn btn-primary file-upload-btn">
                                            <input id="upd_images" type="file" accept="image/*"
                                                   class="file-upload-input" name="upd_images">
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

            var maxLength = 80;
            $('textarea').keyup(function() {
                var length = $(this).val().length;
                var length = maxLength-length;
                $('#countCharacters, .countCharacters').text(length);
            });

            var styles = {
                button: function (row, type, data) {
                    return '<center>' + `<a href="#" class="btn btn-success btn-sm btn-edit" id="${data.id}" data-toggle="modal" data-target="#infoModalColoredHeader1"><i class="icon icon-pencil-square-o"></i></a>
                                             <a href="#" class="btn btn-danger btn-sm btn-delete"  id="${data.id}"><i class="icon icon-trash-o"></i></a>` + '</center>';
                },

                images: function (row, type, data) {
                    return `<img src="{{ asset('storage')}}/${data.images}" width="60px" height="60px">`;
                }
            };

            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],

                ajax: {
                    "url": '{{ URL('mobile/json') }}',
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'images', render: styles.images},
                    {data: 'title'},
                    {data: 'deskripsi'},
                    {data: 'action', orderable: false, render: styles.button}

                ],
            });

            table.on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $(".modal-title-update").html("Update Data Mobile");
                $.ajax({
                    url: "{{ URL('mobile/getMobile') }}",
                    type: "GET",
                    data: "id=" + id,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            $("#id").val(data.list.id);
                            $("#upd_title").val(data.list.title);
                            $("#upd_deskripsi").val(data.list.deskripsi);
                            var count = 80 - data.list.deskripsi.length;
                            $(".countCharacters").html(count);
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
                var title = $("#title").val(),
                    deskripsi = $("#deskripsi").val(),
                    images = $('#ins_images').prop('files')[0],
                    formData = new FormData();

                formData.append('title', title);
                formData.append('deskripsi', deskripsi);
                formData.append('images', images);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('mobile/insert') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
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
                                $('#' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(8000);
                            })
                        }
                        alert(resp.responseJSON.message)
                    }
                });
            });

            $("#btn-update-data").click(function (e) {
                e.preventDefault();
                var title = $("#upd_title").val(),
                    deskripsi = $("#upd_deskripsi").val(),
                    id = $("#id").val(),
                    images = $('#upd_images').prop('files')[0],
                    formData = new FormData();

                formData.append('id', id);
                formData.append('title', title);
                formData.append('deskripsi', deskripsi);
                formData.append('images', images);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('mobile/update') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
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
                                $('.' + key + '-error').html(val[0]).fadeIn(1000).fadeOut(8000);
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
                                    url: "{{ URL('mobile/delete') }}",
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
