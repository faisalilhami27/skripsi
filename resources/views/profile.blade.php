@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel m-b-lg">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active tab1"><a href="#home-11" data-toggle="tab"><span style="color: #FFFFFF">Data User</span></a>
                            </li>
                            <li><a href="#password-11" data-toggle="tab"><span
                                        style="color: #FFFFFF">Change Password</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home-11">
                                <div class="demo-form-wrapper">
                                    <form class="form form-horizontal" id="frm-website" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Nama Lengkap</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="nama_lengkap" autocomplete="off" name="nama_lengkap"
                                                           value="{{ $user->karyawan->nama }}" class="form-control"
                                                           type="text" placeholder="Nama Lengkap" maxlength="60">
                                                    <span class="icon icon-user-secret input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="nama-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Username</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="username" autocomplete="off" name="text"
                                                           value="{{ $user->username }}" class="form-control"
                                                           type="text" placeholder="Username" maxlength="20">
                                                    <span class="icon icon-user input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="username-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Email</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="email" autocomplete="off" maxlength="60" name="email"
                                                           value="{{ $user->karyawan->email }}" class="form-control"
                                                           type="email" placeholder="Email">
                                                    <span class="icon icon-envelope input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="email-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">No Handphone</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="no_hp" autocomplete="off" maxlength="15" name="no_hp"
                                                           value="{{ $user->karyawan->no_hp }}" class="form-control"
                                                           type="text" placeholder="Email">
                                                    <span class="icon icon-phone input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="no_hp-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-5">Foto Profile</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <div class="input-group input-file">
                                                        <input class="form-control" disabled type="text"
                                                               placeholder="No file chosen"
                                                               style="width: 284px; background-color: rgba(0,0,0, 0.1)">
                                                        <span class="icon icon-paperclip input-icon"></span>
                                                        <span class="input-group-btn">
                                                      <label class="btn btn-primary file-upload-btn">
                                                        <input id="gambar" accept="image/*" class="file-upload-input"
                                                               type="file" name="file">
                                                        <span class="icon icon-paperclip icon-lg"></span>
                                                      </label>
                                                    </span>
                                                    </div>
                                                    <strong id="images-error"></strong>
                                                    <p class="help-block">
                                                        <small>Click the button next to the input field.</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" style="margin-left: 36%" id="btn-update-data"
                                                type="submit">Submit
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="password-11">
                                <form class="form form-horizontal" id="form-reset" role="form">
                                    <div class="form-group">
                                        <label class="col-sm-4" for="form-control-1">Password</label>
                                        <div class="col-sm-8">
                                            <div class="input-with-icon">
                                                <div class="input-group">
                                                    <input class="form-control form-password" id="password" maxlength="12"
                                                           type="password" placeholder="Password">
                                                    <span class="input-group-addon">
                                                            <label
                                                                class="custom-control custom-control-primary custom-checkbox">
                                                              <input class="custom-control-input form-checkbox"
                                                                     type="checkbox">
                                                              <span class="custom-control-indicator"></span>
                                                              <span class="custom-control-label">Show</span>
                                                            </label>
                                                    </span>
                                                </div>
                                                <span class="icon icon-lock input-icon"></span>
                                                <span class="text-danger">
                                                        <strong id="password-error"></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4" for="form-control-1">Konfirmasi Password</label>
                                        <div class="col-sm-8">
                                            <div class="input-with-icon">
                                                <div class="input-group">
                                                    <input class="form-control form-password1" id="konf_password"
                                                           maxlength="12" type="password" placeholder="Konfirmasi Password">
                                                    <span class="input-group-addon">
                                                            <label
                                                                class="custom-control custom-control-primary custom-checkbox">
                                                              <input class="custom-control-input form-checkbox1"
                                                                     type="checkbox">
                                                              <span class="custom-control-indicator"></span>
                                                              <span class="custom-control-label">Show</span>
                                                            </label>
                                                    </span>
                                                </div>
                                                <span class="text-danger">
                                                    <strong id="password_confirmation-error"></strong>
                                                </span>
                                                <span class="icon icon-lock input-icon"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" style="margin-left: 36%; margin-top: 5%"
                                            id="btn-reset-pass" type="submit">Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel m-b-lg">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active tab1"><a href="#home-11" data-toggle="tab"><span
                                        style="font-size: 27px; font-weight: bold">Review Data User</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home-11">
                                <div class="profile-avatar">
                                    @if(is_null($user['images']))
                                        <img class="img-circle"
                                             src="{{ asset('img/no_image.svg') }}"
                                             width="128px" height="128px"
                                             style="margin-left: 38%; border: 3px solid #FFFFFF" alt="Profile">
                                    @else
                                        <img class="img-circle"
                                             src="{{ asset('storage/' . $user['images']) }}"
                                             width="128px" height="128px"
                                             style="margin-left: 38%; border: 3px solid #FFFFFF" alt="Profile">
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $user->karyawan->nama }}</h3>
                                    <p class="card-text text-center">
                                        <small>{{ $implode }}</small>
                                    </p>
                                    <p class="card-text text-center">
                                        <small>{{ $user->karyawan->no_hp }}</small>
                                    </p>
                                    <p class="card-text text-center">
                                        <small>{{ $user->karyawan->email }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.form-checkbox').click(function () {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            });

            $('.form-checkbox1').click(function () {
                if ($(this).is(':checked')) {
                    $('.form-password1').attr('type', 'text');
                } else {
                    $('.form-password1').attr('type', 'password');
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

            $("#btn-update-data").click(function (event) {
                event.preventDefault();

                var nama = $("#nama_lengkap").val();
                var username = $("#username").val();
                var email = $("#email").val();
                var no_hp = $("#no_hp").val();
                var images = $('#gambar').prop('files')[0];
                var formData = new FormData();

                formData.append('nama', nama);
                formData.append('email', email);
                formData.append('username', username);
                formData.append('no_hp', no_hp);
                formData.append('images', images);

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ URL('profile/update') }}",
                    data: formData,
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
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

            $("#form-reset").submit(function (e) {
                e.preventDefault();
                var password = $("#password").val();
                var konf_password = $("#konf_password").val();

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    url: "{{ URL('profile/changepassword') }}",
                    type: "PUT",
                    data: "password=" + password + "&password_confirmation=" + konf_password,
                    dataType: "json",
                    success: function (data) {
                        notification(data.status, data.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 1000)
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


            $("#email").keyup(function (e) {
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
                            $("#email-error").css("color", "green");
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

            $("#username").keyup(function (e) {
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
                            $("#username-error").css("color", "green");
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#username-error").html(data.msg);
                            $("#username-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
                        }
                    },
                    error: function (xhr, status, error) {
                        alert(status + " : " + error);
                    }
                });
            });

            $("#no_hp").keyup(function (e) {
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
                            $("#no_hp-error").html("");
                            $("#no_hp-error").css("color", "green");
                            $("#btn-update-data").removeAttr('disabled');
                        } else {
                            $("#no_hp-error").html(data.msg);
                            $("#no_hp-error").css("color", "red");
                            $("#btn-update-data").attr('disabled', 'disabled');
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
