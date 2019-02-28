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
                                <table class="table table-striped">
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
                                    <?php
                                    $no = 1;
                                    foreach ($menu as $m) {
                                        echo "<tr>
											<td>$no</td>
											<td>" . $m->title . "</td>
											<td align='center'>
                                            <label class='switch switch-primary'>
                                                <input class='switch-input change' type='checkbox' id='" . $m->id . "' " . beriAkses(Request::segment(3), $m->id) . ">
                                                <span class='switch-track'></span>
                                                <span class='switch-thumb'></span>
                                            </label>
											</td>
                                           <td align='center'>
                                            <label class='switch switch-success'>
                                                <input class='switch-input create" . $m->id . "' type='checkbox' id='" . $m->id . "' " . create(Request::segment(3), $m->id) . ">
                                                <span class='switch-track'></span>
                                                <span class='switch-thumb'></span>
                                            </label>
											</td>
                                          <td align='center'>
                                            <label class='switch switch-warning'>
                                                <input class='switch-input read" . $m->id . "' type='checkbox' id='" . $m->id . "' " . read(Request::segment(3), $m->id) . ">
                                                <span class='switch-track'></span>
                                                <span class='switch-thumb'></span>
                                            </label>
											</td>
                                           <td align='center'>
                                            <label class='switch switch-info'>
                                                <input class='switch-input update" . $m->id . "' type='checkbox' id='" . $m->id . "' " . update(Request::segment(3), $m->id) . ">
                                                <span class='switch-track'></span>
                                                <span class='switch-thumb'></span>
                                            </label>
											</td>
                                           <td align='center'>
                                            <label class='switch switch-danger'>
                                                <input class='switch-input delete" . $m->id . "' type='checkbox' id='" . $m->id . "' " .delete(Request::segment(3), $m->id) . ">
                                                <span class='switch-track'></span>
                                                <span class='switch-thumb'></span>
                                            </label>
											</td>
											</tr>";
                                        $no++;
                                    } ?>
                                    </tbody>
                                </table>
                                <div class="pull-right">{{ $menu->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".change").each(function () {
                var id = $(this).attr("id");
                if ($(this).is(":checked")) {
                    $(".create" + id).attr("disabled", false);
                    $(".read" + id).attr("disabled", false);
                    $(".update" + id).attr("disabled", false);
                    $(".delete" + id).attr("disabled", false);
                } else {
                    $(".create" + id).attr("disabled", true);
                    $(".read" + id).attr("disabled", true);
                    $(".update" + id).attr("disabled", true);
                    $(".delete" + id).attr("disabled", true);
                }

                $(".create" + id).change(function () {
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
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success(data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        },
                        error: function (xhr, status, error) {
                            alert(status + " : " + error);
                        }
                    });
                });

                $(".read" + id).change(function () {
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
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success(data.msg);
                             setTimeout(function () {
                                location.reload();
                            }, 2000);
                        },
                        error: function (xhr, status, error) {
                            alert(status + " : " + error);
                        }
                    });
                });

                $(".update" + id).change(function () {
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
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success(data.msg);
                             setTimeout(function () {
                                location.reload();
                            }, 2000);
                        },
                        error: function (xhr, status, error) {
                            alert(status + " : " + error);
                        }
                    });
                });

                $(".delete" + id).change(function () {
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
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "3000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success(data.msg);
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

            $(".change").change(function () {
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
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        };
                        toastr.success(data.msg);
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
    </script>
@endsection
