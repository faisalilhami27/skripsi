@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="text-center m-b">
                <h3 class="m-b-0">Kelola Hak Akses Untuk {{ $level->nama_level }}</h3>
                <small>Memberi kewenangan user untuk mengakses modul</small>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="demo-datatables" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th>Nama Modul</th>
                                        <th width="100px">Beri Akses</th>
                                        <th width="100px">Create</th>
                                        <th width="100px">Read</th>
                                        <th width="100px">Update</th>
                                        <th width="100px">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <div class="pull-left" style="margin-top: 20px"><a href="{{ URL('userlevel') }}" class="btn btn-danger btn-sm"><span class="icon icon-backward"></span> Kembali</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var idUser = '{{ $params }}';
            getMenu();
            //	//datatables
            table = $('#demo-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
                order: [],

                ajax: {
                    "url": '{{ URL('userlevel/json2') }}' + '/' + idUser,
                    "type": "POST",
                    "headers": {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                },

                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'title'},
                    {data: 'akses'},
                    {data: 'create'},
                    {data: 'read'},
                    {data: 'update'},
                    {data: 'delete'},
                ],
            });

            table.on('change', '.change', function () {
                var id_menu = $(this).attr("id");
                var level = '{{ Request::segment(3) }}';

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/ubahprivilige') }}",
                    type: "POST",
                    dataType: "json",
                    data: "id_menu=" + id_menu + "&level=" + level,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });
        });

        function getMenu() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ URL('userlevel/getMenu') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i) {
                        crud(data[i].id);
                    })
                },
                error: function (xhr, status, error) {
                    alert(status + " : " + error);
                }
            });
        }

        function crud(id) {
            table.on('change', '.create' + id, function () {
                var id_menu = $(this).attr("id");
                var value = $(".create" + id).is(":checked") ? 1 : 0;
                var field = "create";
                var level = '{{ Request::segment(3) }}';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/updateAccess') }}",
                    type: "PUT",
                    dataType: "json",
                    data: "id_menu=" + id_menu + "&level=" + level + "&value=" + value + "&field=" + field,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            table.on('change', '.read' + id, function () {
                var id_menu = $(this).attr("id");
                var value = $(".read" + id).is(":checked") ? 1 : 0;
                var field = "read";
                var level = '{{ Request::segment(3) }}';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/updateAccess') }}",
                    type: "PUT",
                    dataType: "json",
                    data: "id_menu=" + id_menu + "&level=" + level + "&value=" + value + "&field=" + field,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            table.on('change', '.update' + id, function () {
                var id_menu = $(this).attr("id");
                var value = $(".update" + id).is(":checked") ? 1 : 0;
                var field = "update";
                var level = '{{ Request::segment(3) }}';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/updateAccess') }}",
                    type: "PUT",
                    dataType: "json",
                    data: "id_menu=" + id_menu + "&level=" + level + "&value=" + value + "&field=" + field,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            table.on('change', '.delete' + id, function () {
                var id_menu = $(this).attr("id");
                var value = $(".delete" + id).is(":checked") ? 1 : 0;
                var field = "delete";
                var level = '{{ Request::segment(3) }}';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    url: "{{ URL('userlevel/updateAccess') }}",
                    type: "PUT",
                    dataType: "json",
                    data: "id_menu=" + id_menu + "&level=" + level + "&value=" + value + "&field=" + field,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });
        }
    </script>
@endpush
