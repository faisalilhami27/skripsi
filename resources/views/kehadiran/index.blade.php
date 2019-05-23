@extends('template')
@section('content')
  <div class="layout-content">
    <div class="layout-content-body">
      <button class="btn btn-info btn-sm" type="button" style="margin-bottom: 10px" id="generate"><i
          class="icon icon-gear"></i> Generate Kehadiran
      </button>
      <div class="row gutter-xs">
        <div class="col-xs-12">
          <div class="card">
            <div class="card-header">
              <strong>Kehadiran Karyawan</strong>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="demo-datatables" class="table table-striped table-hover table-nowrap dataTable" width="100%">
                  <thead>
                  <tr>
                    <th width="20px">No</th>
                    <th>Nama Lengkap</th>
                    <th>Tanggal Kehadiran</th>
                    <th>Status</th>
                    <th>Action</th>
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
  </div>
@stop
@push('scripts')
  <script type="text/javascript">
      var table;
      $(document).ready(function () {
          var styles = {
              nama: function (row, type, data) {
                  return data.karyawan.nama;
              },

              tanggal: function (row, type, data) {
                  return data.tanggal + ' - ' + data.waktu ;
              },

              status: function (row, type, data) {
                  if (data.status == 0) {
                      return '<span class="label label-primary">Pending</span>';
                  } else if (data.status == 1) {
                      return '<span class="label label-danger">Tanpa Keterangan</span>';
                  } else if (data.status == 2) {
                      return '<span class="label label-success">Hadir</span>';
                  } else if (data.status == 3) {
                      return '<span class="label label-info">Izin</span>';
                  } else if (data.status == 4) {
                      return '<span class="label label-warning">Sakit</span>';
                  }
              },

              generate: function (row, type, data) {
                  return `<form action="#" method="POST">
                  <div class="select_action">
                    <select id="select_action" style="width: 100%" class="form-control select_action" data-id="${data.id}">
                      <option value="">Pilih Aksi</option>
                      <option value="2">Hadir</option>
                      <option value="3">Izin</option>
                      <option value="4">Sakit</option>
                      <option value="1">Alfa</option>
                    </select>
                  </div>
                </form>`;
              }
          };

          //	//datatables
          table = $('#demo-datatables').DataTable({
              processing: true,
              serverSide: true,
              responsive: true,
              aLengthMenu: [[5, 10, 25, 100], [5, 10, 25, 100]],
              order: [],

              ajax: {
                  "url": '{{ URL('kehadiran/json') }}',
                  "type": "POST",
                  "headers": {
                      "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  },
              },

              columns: [
                  {data: 'DT_RowIndex'},
                  {data: 'nama', render: styles.nama},
                  {data: 'tanggal', render: styles.tanggal},
                  {data: 'status', render: styles.status},
                  {data: 'generate', render: styles.generate},
              ],

              columnDefs: [
                  {
                      targets: [-1, 0], //first column / numbering column
                      orderable: false, //set not orderable
                  },
              ],
          });

          table.on('change', '.select_action', function () {
              if ($(this).val() != '') {
                  var status = $(this).val();
                  var id = $(this).attr('data-id');
                  var sData = "status=" + status + "&id=" + id;

                  $.ajax({
                      headers: {
                          "X-CSRF-TOKEN": "{{ csrf_token() }}",
                      },
                      url: "{{ URL('kehadiran/changeKehadiran') }}",
                      type: "PUT",
                      data: sData,
                      dataType: 'json',
                      success: function (data) {
                          table.ajax.reload(null, false);
                          notification(data.status, data.msg);
                      },
                      error: function (xhr) {
                          alert(xhr);
                      }
                  });
              }
          });

          $("#generate").click(function (e) {
              e.preventDefault();
              $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': "{{ csrf_token() }}"
                  },
                  url: "{{ URL('kehadiran/generateKehadiran') }}",
                  type: "POST",
                  cache: false,
                  dataType: 'json',
                  beforeSend: function () {
                      loadingBeforeSend();
                  },
                  success: function (data) {
                      table.ajax.reload();
                      notification(data.status, data.msg);
                      loadingAfterSend();
                  },
                  error: function (resp) {
                      loadingAfterSend();
                      alert(resp);
                  }
              });
          });
      });

      function loadingBeforeSend() {
          $("#generate").attr('disabled', 'disabled');
          $("#generate").html('Processing....');
      }

      function loadingAfterSend() {
          $("#generate").removeAttr('disabled');
          $("#generate").html('<i class="icon icon-gear"></i> Generate Kehadiran');
      }
  </script>
@endpush
