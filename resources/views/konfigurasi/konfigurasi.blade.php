@extends('template')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel m-b-lg">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active tab1"><a href="#home-11" data-toggle="tab"><h3><span class="icon icon-gear"></span> Data Konfigurasi <span class="icon icon-gear"></span></h3></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home-11">
                                <div class="demo-form-wrapper">
                                    <form class="form form-horizontal" id="frm-website" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Nama Perusahaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="nama_perusahaan" autocomplete="off" maxlength="50" name="nama_perusahaan" value="{{ $konfig[4]->nilai_konfig }}" class="form-control" type="text" placeholder="Nama Perusahaan">
                                                    <span class="icon icon-building input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="nama_perusahaan-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Pemilik Perusahaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="nama_pemilik" autocomplete="off" maxlength="50" name="nama_pemilik" value="{{ $konfig[6]->nilai_konfig }}" class="form-control" type="text" placeholder="Pemilik Perusahaan">
                                                    <span class="icon icon-user input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="nama_pemilik-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Email Perusahaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="email" autocomplete="off" maxlength="60" name="email" value="{{ $konfig[1]->nilai_konfig }}" class="form-control" type="email" placeholder="Email Perusahaan">
                                                    <span class="icon icon-envelope input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="email-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Nomor Telepon</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="no_hp" autocomplete="off" name="no_hp" value="{{ $konfig[5]->nilai_konfig }}" maxlength="12" class="form-control" type="text" placeholder="Nomor Telepon Perusahaan">
                                                    <span class="icon icon-phone input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="no_hp-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Harga Tiket</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="harga" autocomplete="off" name="harga" value="{{ $konfig[2]->nilai_konfig }}" maxlength="12" class="form-control" type="text" placeholder="Nomor Telepon Perusahaan">
                                                    <span class="icon icon-shopping-cart input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="harga-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Versi Aplikasi</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <input id="versi" autocomplete="off" name="versi" value="{{ $konfig[8]->nilai_konfig }}" maxlength="12" class="form-control" type="text" placeholder="Nomor Telepon Perusahaan">
                                                    <span class="icon icon-level-up input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="versi-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-1">Reset Password</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <div class="input-group">
                                                        <input class="form-control form-password" id="password" value="{{ $konfig[7]->nilai_konfig }}" name="password" maxlength="12" minlength="8" type="password" placeholder="Password">
                                                        <span class="input-group-addon">
                                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                              <input class="custom-control-input form-checkbox" type="checkbox">
                                                              <span class="custom-control-indicator"></span>
                                                              <span class="custom-control-label">Show</span>
                                                            </label>
                                                          </span>
                                                        <span class="text-danger">
                                                        <strong id="password-error"></strong>
                                                    </span>
                                                    </div>
                                                    <span class="icon icon-lock input-icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-5">Logo Perusahaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <div class="input-group input-file" >
                                                        <input class="form-control" disabled type="text" placeholder="No file chosen" style="width: 283px; background-color: rgba(0,0,0, 0.1)">
                                                        <span class="icon icon-paperclip input-icon"></span>
                                                        <span class="input-group-btn">
                                                      <label class="btn btn-primary file-upload-btn">
                                                        <input id="gambar" accept="image/*" class="file-upload-input" type="file" name="file">
                                                        <span class="icon icon-paperclip icon-lg"></span>
                                                      </label>
                                                    </span>
                                                    </div>
                                                    <strong id="gambar-error"></strong>
                                                    <p class="help-block" >
                                                        <small>Click the button next to the input field.</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4" for="form-control-6">Alamat Perusahaan</label>
                                            <div class="col-sm-8">
                                                <div class="input-with-icon">
                                                    <textarea id="alamat" name="alamat" class="form-control" maxlength="700" rows="3" placeholder="Alamat Perusahaan">{{ $konfig[0]->nilai_konfig }}</textarea>
                                                    <span class="icon icon-bookmark input-icon"></span>
                                                    <span class="text-danger">
                                                        <strong id="alamat-error"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel m-b-lg">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active tab1"><a href="#home-11" data-toggle="tab"><h3><span class="icon icon-gear"></span> Review Data Konfigurasi <span class="icon icon-gear"></span></h3></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home-11">
                                @if($konfig[3]->nilai_konfig == 'logo2.png')
                                    <img class="img-responsive" src="{{ asset('img/no_image.svg') }}" width="50%" style="margin-left: 25%; margin-top: 0%" alt="Failda">
                                @else
                                    <img class="img-responsive" src="{{ asset('storage/' . $konfig[3]->nilai_konfig) }}" width="70%" style="margin-left: 16%; margin-top: 0%" alt="Failda">
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $konfig[4]->nilai_konfig }}</h3>
                                    <p class="card-text text-center">
                                        <small>{{ $konfig[0]->nilai_konfig }}</small>
                                    </p>
                                    <table class="table table-striped">
                                        <tr>
                                            <td>Nama Pemilik</td>
                                            <td width="1px">:</td>
                                            <td>{{ $konfig[5]->nilai_konfig }}</td>
                                        </tr>
                                        <tr>
                                            <td>No Telepon</td>
                                            <td width="1px">:</td>
                                            <td>{{ $konfig[4]->nilai_konfig }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td width="1px">:</td>
                                            <td>{{ $konfig[1]->nilai_konfig }}</td>
                                        </tr>
                                    </table>
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
            var timeout;
            $('.form-checkbox').click(function(){
                if($(this).is(':checked')){
                    $('.form-password').attr('type','text');
                }else{
                    $('.form-password').attr('type','password');
                }
            });


            $("input, textarea").bind("input", function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $('#frm-website').submit();
                }, 1000)
            });

            $("#frm-website").submit(function (event) {
                event.preventDefault();

                var perusahaan = $("#nama_perusahaan").val();
                var pemilik = $("#nama_pemilik").val();
                var password = $("#password").val();
                var email = $("#email").val();
                var alamat = $("#alamat").val();
                var harga = $("#harga").val();
                var versi = $("#versi").val();
                var noHP = $("#no_hp").val();
                var images = $('#gambar').prop('files')[0];
                var formData = new FormData();

                formData.append('nama_perusahaan', perusahaan);
                formData.append('email', email);
                formData.append('harga', harga);
                formData.append('password', password);
                formData.append('versi', versi);
                formData.append('nama_pemilik', pemilik);
                formData.append('alamat', alamat);
                formData.append('no_hp', noHP);
                formData.append('gambar', images);

                $('input[type=file]').change(function () {
                    var val = $(this).val().toLowerCase(),
                        regex = new RegExp("(.*?)\.(png|jpg|jpeg)$");

                    if (!(regex.test(val))) {
                        $(this).val('');
                        alert('Format yang diizinkan png atau jpg');
                    }
                });

                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ URL('konfigurasi/update') }}",
                    data: formData,
                    success: function (data) {
                        if (data.status == 200) {
                            notification(data.status, data.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        } else if (data.status == 502) {
                            notification(data.status, data.msg);
                        }
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
                    url: "{{ URL('user/cekUsername') }}",
                    type: "GET",
                    data: "email=" + email,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == 200) {
                            $("#email-error").html("");
                            $("#email-error").css("color", "green");
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
